<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Document extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'price',
        'document_type_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($document) {
            SystemLog::today()->appendActivity([
                'type' => 'document',
                'time' => Carbon::now(),
                'description' => "New Document Created $document->name by User ID No: " . auth()->user()->id,
            ]);
        });

        static::deleting(function ($document) {
            SystemLog::today()->appendActivity([
                'type' => 'document',
                'time' => Carbon::now(),
                'description' => "Document $document->name deleted by User ID No: " . auth()->user()->id,
            ]);
        });
    }

    public function updateLogs()
    {
        SystemLog::today()->appendActivity([
            'type' => 'document',
            'time' => Carbon::now(),
            'description' => "Document $this->name Updated by User ID No: " . auth()->user()->id,
        ]);
    }

    public function processes()
    {
        return $this->belongsToMany(DocumentProcess::class, 'document_process_pivot');
    }

    public function requests()
    {
        return $this->belongsToMany(Request::class, 'request_documents')->withPivot('completed_at');
    }

    public function type()
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id');
    }

    public function scopeSearch($query, $value){
        $query->where('id', 'like', "%{$value}%")
        ->orWhere('name', 'like', "%{$value}%")
        ->orWhere('price', 'like', "%{$value}%");
    }
}
