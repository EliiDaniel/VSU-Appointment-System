<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VerifiedEmail extends Model
{
    use HasFactory;
    
    protected $fillable = ['email'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($verified_email) {
            SystemLog::today()->appendActivity([
                'type' => 'verfied_email',
                'time' => Carbon::now(),
                'description' => "New Email Verified $verified_email->email",
            ]);
        });
    }
}