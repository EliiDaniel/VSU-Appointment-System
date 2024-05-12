<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Luigel\Paymongo\Facades\Paymongo;
use Illuminate\Support\Facades\Notification as NotificationEmail;
use App\Notifications\PaymentComplete;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'checkout_id',
        'reference_no',
    ];

    protected static function boot()
    {
        parent::boot();
    
        static::created(function ($transaction) {
            if (auth()->user()) {
                Notification::create([
                    'title' => "Transaction Complete",
                    'content' => json_encode(['transaction', $transaction->checkout_id, $transaction->reference_no]),
                    'user_id' => auth()->user()->id,
                ]);
                if (auth()->user()->hasVerifiedEmail()) {
                    NotificationEmail::route('mail', auth()->user()->email)->notify(new PaymentComplete($transaction->reference_no));
                }
            }
            else {
                $email = Paymongo::checkout()->find($transaction->checkout_id)->getData()['billing']['email'];
                NotificationEmail::route('mail', $email)->notify(new PaymentComplete($transaction->reference_no));
            }

            SystemLog::today()->appendActivity([
                'type' => 'transaction',
                'time' => Carbon::now(),
                'description' => "Transaction Created, Reference No: $transaction->reference_no",
            ]);

            $transaction->sendEmailNotificationsToCashiers();
        });
    }

    private function sendEmailNotificationsToCashiers()
    {
        $cashiers = User::whereIn('role', ['cashier', 'admin'])->get();

        foreach ($cashiers as $cashier) {
            Notification::create([
                'title' => "Transaction Complete",
                'content' => json_encode(['transaction', $this->checkout_id, $this->reference_no]),
                'user_id' => $cashier->id,
            ]);

            if ($cashier->hasVerifiedEmail()) {
                NotificationEmail::route('mail', $cashier->email)->notify(new PaymentComplete($this->reference_no));
            }
        }
    }

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function scopeSearch($query, $value){
        $query->where('id', 'like', "%{$value}%")
        ->orWhere('checkout_id', 'like', "%{$value}%")
        ->orWhere('reference_no', 'like', "%{$value}%");
    }
}
