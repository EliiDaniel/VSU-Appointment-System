<?php

namespace App\Livewire\Cashier;

use Livewire\Component;
use App\Models\Request;
use App\Models\Document;
use App\Models\DocumentProcess;
use App\Models\RequestDocumentProcess;
use Livewire\WithPagination;

class Requests extends Component
{
    use WithPagination;

    public $search = '';
    public $shownEntries = 5;
    public $sortBy = 'appointment_date';
    public $sortDir = 'DESC';
    public $statuses = ['Payment Approval', 'Awaiting Payment', 'Ready for Collection', 'Completed', 'Canceled', 'Rejected'];
    public $status = '';
    public $type = '';
    public $title = 'view-request';
    public $selectedDocuments = [];
    public ?Request $selectedRequest;
    public $selectedRequestStatus = '';
    public ?Document $selectedDocument;
    public $completedProcesses = [];
    public $pivotId;
    public $reason;
    public ?Request $toReject;

    public function render()
    {
        return view('livewire.cashier.requests', [
            'requests' => Request::whereIn('status', $this->statuses)
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
        ]);
    }

    public function openFilters(){
        $this->title = 'filters';

        $this->dispatch('open-modal', 'request-modal');
    }

    public function rejectRequest(){
        if(!$this->toReject->rejected_at)
        {
            $this->toReject->reject($this->reason);
            $this->reason = "";

            $this->notification([
                'title'       => 'Request successfully rejected!',
                'icon'        => 'success'
            ]);
        }
        else
        {
            $this->notification([
                'title'       => 'Request was already rejected!',
                'icon'        => 'error'
            ]);
        }
    }

    public function viewRequest(Request $request){
        $this->selectedRequest = $request;

        $this->selectedRequestStatus = $request->status;
        $this->selectedDocument = null;

        $this->dispatch('close-modal', 'view-document');
        $this->dispatch('open-modal', 'request-modal');
    }

    public function viewDocumentProcess(Document $document, $pivotId){
        $this->selectedDocument = $document;
        $this->pivotId = $pivotId;
        $this->completedProcesses = RequestDocumentProcess::where('request_document_id', $pivotId)->pluck('document_process_id');

        $this->dispatch('open-modal', 'view-document');
    }

    public function approveRequest(){
        $this->selectedRequest->approvePayment();
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
