<?php

namespace App\Livewire\Requester;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Document;

class Index extends Component
{
    public function render()
    {
        return view('livewire.requester.index', [
            'documents' => Document::all(),
        ]);
    }
    
    public function createRequest(){
        $this->dispatch('open-modal', 'create-request');
    }
}
