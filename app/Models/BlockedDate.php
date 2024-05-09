<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BlockedDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($blocked_date) {
            SystemLog::today()->appendActivity([
                'type' => 'blocked_date',
                'time' => Carbon::now(),
                'description' => "New Blocked Date Created, ID No: $blocked_date->id, by User ID No: " . auth()->user()->id,
            ]);
        });

        static::deleting(function ($blocked_date) {
            SystemLog::today()->appendActivity([
                'type' => 'blocked_date',
                'time' => Carbon::now(),
                'description' => "Blocked Date ID No: $blocked_date->id deleted by User ID No: " . auth()->user()->id,
            ]);
        });
    }

    public static function getFormattedBlockedDates($minDate, $maxDate)
    {
        $minDate = Carbon::parse($minDate);
        $maxDate = Carbon::parse($maxDate);

        $blockedDates = self::whereBetween('date', [$minDate, $maxDate])->get();

        $formattedDates = $blockedDates->map(function ($blockedDate) {
            $carbonDate = Carbon::parse($blockedDate->date);
            return $carbonDate->format('Y-n-j');
        });

        return $formattedDates;
    }

    public function scopeSearch($query, $value){
        $query->where('date', 'like', "%{$value}%");
    }
}
