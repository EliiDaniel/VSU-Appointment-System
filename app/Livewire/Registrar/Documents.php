<?php

namespace App\Livewire\Registrar;

use Livewire\Component;
use App\Models\Document;
use App\Models\DocumentProcess;
use Livewire\WithPagination;

class Documents extends Component
{
    use WithPagination;

    public $search = '';
    public $shownEntries = 5;
    public $sortBy = 'id';
    public $sortDir = 'ASC';
    public Document $selectedDocument;

    public function mount()
    {
        if (Document::count() > 0) {
            $this->selectedDocument = Document::first();
        }
    }

    public function render()
    {
        return view('livewire.registrar.documents', [
            'documents' => Document::search($this->search)
                        ->orderBy($this->sortBy, $this->sortDir)
                        ->paginate($this->shownEntries),
            'processes' => DocumentProcess::all()
        ]);
    }

    public function showDocument(Document $document){
        $this->selectedDocument = $document;

        $this->dispatch('open-modal', 'view-document');
    }
    
    public function createDocument(){
        $this->dispatch('open-modal', 'create-document');
    }

    public function createProcess(){
        $this->dispatch('open-modal', 'create-process');
    }

    public function setSortBy($col){
        $this->sortDir = ($this->sortBy === $col) ? (($this->sortDir == 'DESC') ? 'ASC' : 'DESC') : 'ASC';
        $this->sortBy = ($this->sortBy === $col) ? $this->sortBy : $col;
    }

    //Updates on page when shown entries is updated
    public function updatedShownEntries()
    {
        $this->resetPage();
    }

    public function updatedRole()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
}
