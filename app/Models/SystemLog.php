<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SystemLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity',
    ];

    public static function today()
    {
        return self::whereDate('created_at', Carbon::today())->firstOrCreate([]);
    }

    public function appendActivity($additionalData)
    {
        $existingActivity = json_decode($this->activity, true) ?? [];
        $existingActivity[] = $additionalData;
        $this->update(['activity' => json_encode($existingActivity)]);
    }

    public function scopeSearch($query, $value){
        $query->where('id', 'like', "%{$value}%")
            ->orWhereJsonContains('activity', $value);
    }
}
