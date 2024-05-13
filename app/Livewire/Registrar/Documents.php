<?php

namespace App\Livewire\Registrar;

use Livewire\Component;
use App\Models\Document;
use App\Models\DocumentProcess;
use App\Models\DocumentType;
use Livewire\WithPagination;

class Documents extends Component
{
    use WithPagination;

    public $search = '';
    public $title = 'view-document';
    public $shownEntries = 5;
    public $type = '';
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
                        ->when($this->type !== '', function($query){
                            $query->where('document_type_id', $this->type);
                        })
                        ->orderBy($this->sortBy, $this->sortDir)
                        ->paginate($this->shownEntries),
            'processes' => DocumentProcess::all(),
            'document_types' => DocumentType::all(),
        ]);
    }

    public function showDocument(Document $document){
        $this->selectedDocument = $document;
        $this->title = "view-document";

        $this->dispatch('open-modal', 'document-modal');
    }
    
    public function createDocument(){
        $this->title = "create-document";

        $this->dispatch('open-modal', 'document-modal');
    }

    public function createDocumentType(){
        $this->title = "create-document-type";

        $this->dispatch('open-modal', 'document-modal');
    }

    public function deleteDocument(Document $document){
        $document->delete();
    }

    public function createProcess(){
        $this->title = "create-process";

        $this->dispatch('open-modal', 'document-modal');
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
