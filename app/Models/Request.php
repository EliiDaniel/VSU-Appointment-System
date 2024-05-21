<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification as NotificationEmail;
use App\Notifications\RequestStatusUpdate;
use Carbon\Carbon;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'verified_email_id',
        'tracking_code',
        'price',
        'payment_type',
        'appointment_date',
        'status',
        'approved_at',
        'completed_at',
        'canceled_at',
        'claimed_at',
        'paid_at',
        'rejected_at',
    ];

    protected static function boot()
    {
        parent::boot();
    
        static::created(function ($request) {
            do {
                $hash = uniqid() . mt_rand(1000, 9999);

                $existingRequest = self::where('tracking_code', $hash)->first();
            } while ($existingRequest);
            $request->update(['tracking_code' => $hash]);
        });

        static::updating(function ($request) {
            if ($request->isDirty('status')) {
                if ($request->user) {
                    Notification::create([
                        'title' => "Request #..." . substr($request->tracking_code, -6) . " Status Update",
                        'content' => json_encode(['request', $request->tracking_code, $request->status]),
                        'user_id' => $request->user->id,
                    ]);
                }

                if (in_array($request->status, ['Payment Approval', 'Awaiting Payment'])) {
                    $request->sendEmailNotificationsToCashiers();
                }

                if (auth()->user() !== $request->user) {
                    SystemLog::today()->appendActivity([
                        'type' => 'request',
                        'time' => Carbon::now(),
                        'description' => "Request No: " . $request->id . " updated to $request->status, by User ID No: " . auth()->user()->id,
                    ]);
                } else {
                    SystemLog::today()->appendActivity([
                        'type' => 'request',
                        'time' => Carbon::now(),
                        'description' => "Request No: " . $request->id . " updated to $request->status, by Requester " . auth()->user()?->id,
                    ]);
                }

                $request->sendEmailNotifications();
            }

            if ($request->isDirty('tracking_code')) {
                if ($request->user) {
                    Notification::create([
                        'title' => "Request #..." . substr($request->tracking_code, -6) . " Created",
                        'content' => json_encode(['request', $request->tracking_code, 'pending for approval.']),
                        'user_id' => $request->user->id,
                    ]);
                    if ($request->user->hasVerifiedEmail()) {
                        NotificationEmail::route('mail', $request->user->email)->notify(new RequestStatusUpdate(url('/requester/requests/?tracking_code=' . $request->tracking_code), "You have successfully filed a new request with tracking code $request->tracking_code,now pending for approval."));
                    }

                    SystemLog::today()->appendActivity([
                        'type' => 'request',
                        'time' => Carbon::now(),
                        'description' => "New Request by User ID: " . $request->user->id,
                    ]);
                }

                $request->sendEmailNotificationsToRegistrars();

                if ($request->verified_email) {
                    SystemLog::today()->appendActivity([
                        'type' => 'request',
                        'time' => Carbon::now(),
                        'description' => "New Request by: " . $request->verified_email->email,
                    ]);
                    NotificationEmail::route('mail', $request->verified_email->email)->notify(new RequestStatusUpdate(url('?tracking_code=' . $request->tracking_code), "You have successfully filed a new request with tracking code $request->tracking_code,now pending for approval."));
                }
            }
        });
    }

    private function sendEmailNotificationsToRegistrars()
    {
        $registrars = User::whereIn('role', ['registrar', 'admin'])->get();

        foreach ($registrars as $registrar) {
            Notification::create([
                'title' => "Request #..." . substr($this->tracking_code, -6) . " Created",
                'content' => json_encode(['request', $this->tracking_code, 'pending for approval.']),
                'user_id' => $registrar->id,
            ]);

            if ($registrar->hasVerifiedEmail()) {
                NotificationEmail::route('mail', $registrar->email)->notify(new RequestStatusUpdate(url('/requester/requests/?tracking_code=' . $this->tracking_code), "The status of your request with tracking code $this->tracking_code has been updated to $this->status."));
            }
        }
    }

    private function sendEmailNotificationsToCashiers()
    {
        $cashiers = User::whereIn('role', ['cashier', 'admin'])->get();

        foreach ($cashiers as $cashier) {
            Notification::create([
                'title' => "Request #..." . substr($this->tracking_code, -6) . " Status Update",
                'content' => json_encode(['request', $this->tracking_code, $this->status]),
                'user_id' => $cashier->id,
            ]);

            if ($cashier->hasVerifiedEmail()) {
                NotificationEmail::route('mail', $cashier->email)->notify(new RequestStatusUpdate(url('/requester/requests/?tracking_code=' . $this->tracking_code), "The status of your request with tracking code $this->tracking_code has been updated to $this->status."));
            }
        }
    }

    private function sendEmailNotifications()
    {
        if ($this->user && $this->user->hasVerifiedEmail()) {
            NotificationEmail::route('mail', $this->user->email)->notify(new RequestStatusUpdate(url('/requester/requests/?tracking_code=' . $this->tracking_code), "The status of your request with tracking code $this->tracking_code has been updated to $this->status."));
        }
        elseif ($this->verified_email) {
            NotificationEmail::route('mail', $this->verified_email->email)->notify(new RequestStatusUpdate(url('?tracking_code=' . $this->tracking_code), "The status of your request with tracking code $this->tracking_code has been updated to $this->status."));
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function verified_email()
    {
        return $this->belongsTo(VerifiedEmail::class);
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'request_documents')->withPivot('id', 'document_id', 'quantity', 'price', 'completed_at');
    }

    public function isDocumentComplete($pivotId)
    {
        return $this->documents()->wherePivot('id', $pivotId)->first()->processes()->count() === RequestDocumentProcess::where('request_document_id', $pivotId)->count();
    }

    public function areAllDocumentsCompleted()
    {
        $documents = $this->documents;

        foreach ($documents as $document) {
            if (!$this->isDocumentComplete($document->pivot->id)) {
                $this->update(['status' => 'In Progress']);
                return 'false';
            }
        }

        $this->update(['status' => $this->paid_at ? 'Ready for Collection' : ($this->transaction ? 'Payment Approval' : 'Awaiting Payment')]);
        return 'true';
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function rejectedRequest()
    {
        return $this->hasOne(RejectedRequest::class);
    }

    public function isRejected()
    {
        return $this->rejectedRequest()->exists();
    }

    public function cancel()
    {
        $this->update(['canceled_at' => date('Y-m-d H:i:s'), 'status' => 'Canceled']);
    }
    
    public function reject($reason)
    {
        if (Gate::allows('reject-request')) {
            RejectedRequest::create([
                'request_id' => $this->id,
                'user_id' => auth()->user()->id, // Or whoever is rejecting the request
                'reason' => $reason ? $reason : 'This request did not meet the requirements',
            ]);
            $this->update(['rejected_at' => date('Y-m-d H:i:s'), 'status' => 'Rejected']);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function approve()
    {
        if (Gate::allows('approve-request') && !$this->approved_at) {
            $this->update(['approved_at' => date('Y-m-d H:i:s'), 'status' => 'In Progress']);
            return response()->json(['message' => 'Request approved successfully'], 200);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function approvePayment()
    {
        if (Gate::allows('approve-request-payment') && !$this->paid_at) {
            $this->update(['paid_at' => date('Y-m-d H:i:s'), 'status' => 'Ready for Collection']);
            return response()->json(['message' => 'Request approved successfully'], 200);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function complete()
    {
        if (Gate::allows('complete-request') && !$this->completed_at) {
            $this->update(['completed_at' => date('Y-m-d H:i:s'), 'status' => 'Completed']);
            return response()->json(['message' => 'Request approved successfully'], 200);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public static function numberOfRequestsOn($date)
    {
        $formattedDate = date('Y-n-j', strtotime($date));

        $count =  self::whereDate('appointment_date', '=', $formattedDate)->count();

        return $count;
    }

    public function scopeSearch($query, $value){
        $query->where('tracking_code', 'like', "%{$value}%")
                ->orWhereHas('user', function ($query) use ($value) {
                    $query->where('name', 'like', "%{$value}%");})
                ->orWhereHas('verified_email', function ($query) use ($value) {
                    $query->where('email', 'like', "%{$value}%");});
    }
}
