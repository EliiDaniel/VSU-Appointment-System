<?php

namespace App\Livewire\Registrar;

use App\Models\Credential;
use Livewire\Component;
use App\Models\Request;
use App\Models\Document;
use App\Models\RequestDocumentProcess;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Requests extends Component
{
    use WithPagination;

    public $search = '';
    public $shownEntries = 5;
    public $sortBy = 'appointment_date';
    public $sortDir = 'DESC';
    public $statuses = ['Pending Approval', 'In Progress', 'Payment Approval', 'Awaiting Payment', 'Ready for Collection', 'Completed', 'Canceled'];
    public $status = '';
    public $type = '';
    public $title = 'view-request';
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

    public function viewRequest(Request $request){
        $this->selectedRequest = $request;
        $this->title = 'view-request';

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

    public function setSortBy($col){
        $this->sortDir = ($this->sortBy === $col) ? (($this->sortDir == 'DESC') ? 'ASC' : 'DESC') : 'ASC';
        $this->sortBy = ($this->sortBy === $col) ? $this->sortBy : $col;
    }

    public function modifyDocProcess()
    {
        $pivotId = $this->pivotId;
        RequestDocumentProcess::where('request_document_id', $pivotId)
            ->whereNotIn('document_process_id', $this->completedProcesses)
            ->delete();

        $missingProcess = collect($this->completedProcesses)->diff(
            RequestDocumentProcess::where('request_document_id', $pivotId)
                ->pluck('document_process_id')
        );
        $missingProcess->each(function ($id) use ($pivotId) {
            RequestDocumentProcess::create([
                'request_document_id' => $this->pivotId,
                'document_process_id' => $id,
            ]);
        });

        $this->selectedRequest->areAllDocumentsCompleted();
    }

    public function downloadCredentials()
    {
        $credentials = Credential::where('verified_email_id', $this->selectedRequest->verified_email->id)->get();

        foreach ($credentials as $credential) {
            $ext = pathinfo($credential->file_name, PATHINFO_EXTENSION);

            $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . app('googleAccessToken'), 
                ])->get("https://www.googleapis.com/drive/v3/files/{$credential->file_id}?alt=media");

            if ($response->successful()) {
                // Ensure the directory exists
                $filePath = 'downloads/' . $credential->file_name . '.' . $ext;
                
                Storage::put($filePath, $response->body());

                return Storage::download($filePath);
            }
        }
    }

    public function approveRequest()
    {
        $this->selectedRequest->approve();
    }

    public function completeRequest()
    {
        $this->selectedRequest->complete();
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
