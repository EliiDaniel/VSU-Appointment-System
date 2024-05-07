<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'read_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function markAsRead()
    {
        if (!$this->read_at) {
            $this->update(['read_at' => date('Y-m-d H:i:s')]);
        }
    }

    public function scopeSearch($query, $value){
        $query->where('title', 'like', "%{$value}%")
            ->orWhereJsonContains('content', $value);
    }
}
