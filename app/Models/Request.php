<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'price',
        'payment_type',
        'appointment_date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            $model->status = 'Canceled';
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
