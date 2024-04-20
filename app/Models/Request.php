<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'verified_email_id',
        'price',
        'payment_type',
        'appointment_date',
    ];

    protected static function boot()
    {
        parent::boot();
    
        static::created(function ($request) {
            do {
                $hash = Hash::make($request->id);
                $hashLength = 10;
                $hash = substr($hash, 0, $hashLength);

                $existingRequest = self::where('tracking_code', $hash)->first();
            } while ($existingRequest);
            $request->tracking_code = $hash;
            $request->save();
        });

        static::updating(function ($model) {
            $model->status = 'Canceled';
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
        return $this->belongsToMany(Document::class, 'request_documents')->withPivot('id', 'completed_at');
    }

    public function isDocumentComplete($pivotId)
    {
        return $this->documents()->wherePivot('id', $pivotId)->first()->processes()->count() === RequestDocumentProcess::where('request_document_id', $pivotId)->count();
    }

    public function scopeSearch($query, $value){
        $query->where('id', 'like', "%{$value}%");
    }
}
