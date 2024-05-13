<?php

namespace App\Livewire\Requester;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\DocumentType;
use App\Models\Document;

class Index extends Component
{
    public $title = 'create-request';

    public function render()
    {
        return view('livewire.requester.index', [
            'documents' => Document::all(),
            'document_types' => DocumentType::all(),
            'dir' => 'requester.requests',
        ]);
    }
    
    public function createRequest(){
        $this->dispatch('open-modal', 'request-modal');
    }
    
    public function firstTimeLogin(){
        auth()->user()->update(['first_time_login' => false]);
    }
}
