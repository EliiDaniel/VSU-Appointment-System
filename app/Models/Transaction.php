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
    ];

    protected static function boot()
    {
        parent::boot();
    
        static::created(function ($transaction) {
            $reference = Paymongo::checkout()->find($transaction->checkout_id)->getData()['reference_number'];
            if (auth()->user()) {
                Notification::create([
                    'title' => "Transaction Complete",
                    'content' => json_encode(['transaction', $transaction->checkout_id, $reference]),
                    'user_id' => auth()->user()->id,
                ]);
                if (auth()->user()->hasVerifiedEmail()) {
                    NotificationEmail::route('mail', auth()->user()->email)->notify(new PaymentComplete($reference));
                }
            }
            else {
                $email = Paymongo::checkout()->find($transaction->checkout_id)->getData()['billing']['email'];
                NotificationEmail::route('mail', $email)->notify(new PaymentComplete($reference));
            }

            SystemLog::today()->appendActivity([
                'type' => 'transaction',
                'time' => Carbon::now(),
                'description' => "Transaction Created, Reference No: $reference",
            ]);

            $transaction->sendEmailNotificationsToCashiers($reference);
        });
    }

    private function sendEmailNotificationsToCashiers($reference)
    {
        $cashiers = User::whereIn('role', ['cashier', 'admin'])->get();

        foreach ($cashiers as $cashier) {
            Notification::create([
                'title' => "Transaction Complete",
                'content' => json_encode(['transaction', $this->checkout_id, $reference]),
                'user_id' => $cashier->id,
            ]);

            if ($cashier->hasVerifiedEmail()) {
                NotificationEmail::route('mail', $cashier->email)->notify(new PaymentComplete($reference));
            }
        }
    }

    public function request()
    {
        return $this->belongsTo(Request::class);
    }
}
