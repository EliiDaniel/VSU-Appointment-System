<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'price',
    ];

    public function processes()
    {
        return $this->belongsToMany(DocumentProcess::class, 'document_process_pivot');
    }

    public function requests()
    {
        return $this->belongsToMany(Request::class, 'request_documents')->withPivot('completed_at');
    }

    public function scopeSearch($query, $value){
        $query->where('id', 'like', "%{$value}%")
        ->orWhere('name', 'like', "%{$value}%")
        ->orWhere('price', 'like', "%{$value}%");
    }
}
