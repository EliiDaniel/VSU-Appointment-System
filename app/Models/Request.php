<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

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
                Notification::create([
                    'title' => "Request #..." . substr($request->tracking_code, -6) . " Status Update",
                    'content' =>  json_encode([$request->tracking_code, $request->status]),
                    'user_id' => $request->user->id,
                ]);
            }
        });
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
        return $this->belongsToMany(Document::class, 'request_documents')->withPivot('id', 'quantity', 'completed_at');
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

    public function cancel()
    {
        if (Gate::allows('cancel-request') && !$this->canceled_at && !$this->approved_at) {
            $this->update(['canceled_at' => date('Y-m-d H:i:s'), 'status' => 'Canceled']);
            return response()->json(['message' => 'Request canceled successfully'], 200);
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
        $query->where('tracking_code', 'like', "%{$value}%");
    }
}
