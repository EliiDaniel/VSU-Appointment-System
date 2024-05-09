<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'enabled_days',
        'daily_limit',
        'min',
        'max',
        'min_time',
        'max_time',
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($schedule) {
            SystemLog::today()->appendActivity([
                'type' => 'schedule',
                'time' => Carbon::now(),
                'description' => "Schedule Settings Updated by User ID No: " . auth()->user()->id,
            ]);
        });
    }
}
