<?php

namespace App\Livewire\Requester;

use Livewire\Component;
use Carbon\Carbon;

class Index extends Component
{
    public function render()
    {
        return view('livewire.requester.index');
    }
    
    public function createRequest(){
        $this->dispatch('open-modal', 'create-request');
    }
}
