<?php

namespace App\Livewire\Registrar;

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
    public $sortDir = 'ASC';
    public $statuses = ['Pending Approval', 'In Progress', 'Awaiting Payment', 'Ready for Collection', 'Completed'];
    public $status = '';
    public $type = '';
    public $selectedDocuments = [];
    public Request $selectedRequest;
    public $selectedRequestStatus = '';
    public ?Document $selectedDocument;
    public $completedProcesses = [];
    public $pivotId;

    public function mount()
    {
        if (Request::count() > 0) {
            $this->selectedRequest = Request::first();
        }
    }

    public function render()
    {
        return view('livewire.registrar.requests', [
            'requests' => Request::when($this->status !== '', function($query){
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
                        ->orderBy($this->sortBy, $this->sortDir)
                        ->paginate($this->shownEntries),
            'documents' => Document::all(),
        ]);
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

    public function modifyProcess($documentProcess)
    {
        $docProcess = RequestDocumentProcess::exists($this->pivotId, $documentProcess);
        if ($docProcess) {
            $docProcess->delete();
        } else {
            RequestDocumentProcess::create([
                'request_document_id' => $this->pivotId,
                'document_process_id' => $documentProcess,
            ]);
        }

        $this->selectedRequest->areAllDocumentsCompleted();
        $this->completedProcesses = RequestDocumentProcess::where('request_document_id', $this->pivotId)->pluck('document_process_id');
    }

    public function approveRequest()
    {
        $this->selectedRequest->approve();
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
