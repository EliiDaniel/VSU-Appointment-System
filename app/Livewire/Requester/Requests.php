<?php

namespace App\Livewire\Requester;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Request;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\RequestDocumentProcess;
use WireUi\Traits\Actions;

class Requests extends Component
{
    use WithPagination;
    use Actions;

    public $search = '';
    public $shownEntries = 5;
    public $sortBy = 'appointment_date';
    public $sortDir = 'DESC';
    public $statuses = ['Pending Approval', 'In Progress', 'Payment Approval', 'Awaiting Payment', 'Ready for Collection', 'Completed', 'Canceled', 'Rejected'];
    public $status = '';
    public $type = '';
    public $selectedDocuments = [];
    public $title = 'create-request';
    public ?Request $selectedRequest;
    public ?Document $selectedDocument;
    public $completedProcesses = [];
    public $pivotId;

    public function sessionNotif($session)
    {
        $this->notification([
            'title'       => $session,
            'icon'        => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.requester.requests', [
            'requests' => Request::where('user_id', auth()->user()->id)
                        ->when($this->status !== '', function($query){
                            $query->where('status', $this->status);
                        })
                        ->when($this->type !== '', function($query){
                            $query->where('payment_type', $this->type);
                        })
                        ->when(!empty($this->selectedDocuments), function($query){
                            $query->whereHas('documents', function($subQuery) {
                                $subQuery->whereIn('name', $this->selectedDocuments);
                            });
                        })
                        ->search($this->search)
                        ->orderBy($this->sortBy, $this->sortDir)
                        ->paginate($this->shownEntries),
            'documents' => Document::all(),
            'document_types' => DocumentType::all(),
            'dir' => 'requester.requests',
        ]);
    }

    public function createRequest(){
        $this->title = 'create-request';
        $this->selectedDocument = null;

        $this->dispatch('open-modal', 'request-modal');
    }
    
    public function openFilters(){
        $this->title = 'filters';

        $this->dispatch('open-modal', 'request-modal');
    }
    
    public function viewRequest(Request $request){
        $this->selectedRequest = $request;
        $this->selectedDocument = null;
        $this->title = 'view-request';

        $this->dispatch('close-modal', 'view-document');
        $this->dispatch('open-modal', 'request-modal');
    }

    public function cancelRequest(Request $request){
        $this->dialog()->confirm([
            'title'       => 'Are you sure you want to cancel your request?',
            'icon'        => 'warning',
            'method'      => 'cancelConfirmed',
            'params'      => $request,
        ]);
    }

    public function cancelConfirmed(Request $request)
    {
        $request->cancel();
        $this->notification([
            'title'       => 'Request canceled successfully!',
            'icon'        => 'success'
        ]);
    }

    public function viewDocumentProcess(Document $document, $pivotId){
        $this->selectedDocument = $document;
        $this->pivotId = $pivotId;
        $this->completedProcesses = RequestDocumentProcess::where('request_document_id', $pivotId)->pluck('document_process_id');

        $this->dispatch('open-modal', 'view-document');
    }

    public function firstTimeLogin(){
        auth()->user()->update(['first_time_login' => false]);
    }

    public function setSortBy($col){
        $this->sortDir = ($this->sortBy === $col) ? (($this->sortDir == 'DESC') ? 'ASC' : 'DESC') : 'ASC';
        $this->sortBy = ($this->sortBy === $col) ? $this->sortBy : $col;
    }

    public function updatedShownEntries()
    {
        $this->resetPage();
    }

    public function updatedType()
    {
        $this->resetPage();
    }

    public function updatedStatus()
    {
        $this->resetPage();
    }

    public function updatedSelectedDocuments()
    {
        $this->resetPage();
    }
}
