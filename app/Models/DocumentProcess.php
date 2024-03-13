<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentProcess extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'completed_at',
    ];

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'document_process_pivot')->withPivot('completed_at');
    }
}
