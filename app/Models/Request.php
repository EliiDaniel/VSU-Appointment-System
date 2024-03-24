<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'request_documents')->withPivot('completed_at');
    }

    public function scopeSearch($query, $value){
        $query->where('id', 'like', "%{$value}%");
    }
}
