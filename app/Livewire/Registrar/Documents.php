<?php

namespace App\Livewire\Registrar;

use Livewire\Component;
use App\Models\Document;
use App\Models\DocumentProcess;
use App\Models\DocumentType;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Documents extends Component
{
    use WithPagination;
    use Actions;

    public $search = '';
    public $title = 'view-document';
    public $shownEntries = 5;
    public $type = '';
    public $sortBy = 'id';
    public $sortDir = 'ASC';
    public Document $selectedDocument;
    public $state = [];

    public function mount()
    {
        if (Document::count() > 0) {
            $this->selectedDocument = Document::first();
        }
        $this->state = ([
            'process_name' => '',
            'document_type' => 'asdasd',
        ]);
    }

    public function sessionNotif($session)
    {
        $this->notification([
            'title'       => $session,
            'icon'        => 'success'
        ]);
    }

    public function createDocProcess()
    {
        $this->validate([
            'state.process_name' => 'required|string|max:255|unique:document_processes,name',
        ]);

        $this->dialog()->confirm([
            'title'       => 'Add new process?',
            'icon'        => 'warning',
            'method'      => 'confirmCreateProcess',
        ]);
    }

    public function confirmCreateProcess()
    {
        DocumentProcess::create([
            'name' => $this->state['process_name'],
        ]);

        $this->notification([
            'title'       => 'New process added!',
            'icon'        => 'success'
        ]);
    }

    public function createType()
    {
        $this->validate([
            'state.document_type' => 'required|string|max:255|unique:document_types,name',
        ]);

        $this->dialog()->confirm([
            'title'       => 'Add new document type?',
            'icon'        => 'warning',
            'method'      => 'confirmCreateType',
        ]);
    }

    public function confirmCreateType()
    {
        DocumentType::create([
            'name' => $this->state['document_type'],
        ]);

        $this->notification([
            'title'       => 'New document type added!',
            'icon'        => 'success'
        ]);
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
        $this->notification([
            'title'       => 'Document deleted!',
            'icon'        => 'success'
        ]);
    }

    public function createProcess(){
        $this->title = "create-process";

        $this->dispatch('open-modal', 'document-modal');
    }

    public function setSortBy($col){
        $this->sortDir = ($this->sortBy === $col) ? (($this->sortDir == 'DESC') ? 'ASC' : 'DESC') : 'ASC';
        $this->sortBy = ($this->sortBy === $col) ? $this->sortBy : $col;
    }

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
