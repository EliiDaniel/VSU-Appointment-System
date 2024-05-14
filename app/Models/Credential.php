<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    use HasFactory;
    protected $fillable = [
        'requester_name',
        'school_id',
        'file_id',
        'file_name',
        'user_id',
        'verified_email_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function verified_email()
    {
        return $this->belongsTo(VerifiedEmail::class, 'verified_email_id');
    }
}
