<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RequestDocumentProcess extends Pivot
{
    protected $table = 'request_document_processes';

    protected $fillable = [
        'request_document_id',
        'document_process_id',
    ];

    public static function exists($requestDocumentId, $documentProcessId)
    {
        return static::where('request_document_id', $requestDocumentId)
            ->where('document_process_id', $documentProcessId)
            ->first();
    }
}
