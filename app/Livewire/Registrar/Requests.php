<?php

namespace App\Livewire\Registrar;

use Livewire\Component;
use App\Models\Request;
use App\Models\Document;
use App\Models\DocumentProcess;
use Livewire\WithPagination;

class Requests extends Component
{
    use WithPagination;

    public $search = '';
    public $shownEntries = 5;
    public $sortBy = 'id';
    public $sortDir = 'ASC';
    public Request $selectedRequest;

    public function mount()
    {
        if (Request::count() > 0) {
            $this->selectedRequest = Request::first();
        }
    }

    public function render()
    {
        return view('livewire.registrar.requests', [
            'requests' => Request::search($this->search)
                        ->orderBy($this->sortBy, $this->sortDir)
                        ->paginate($this->shownEntries),
        ]);
    }
}
