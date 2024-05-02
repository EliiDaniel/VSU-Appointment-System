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
}
