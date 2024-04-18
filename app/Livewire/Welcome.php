<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Request;
use App\Models\Document;
use App\Models\RequestDocumentProcess;

class Welcome extends Component
{
    public ?Request $request;
    public ?Document $selectedDocument;
    public $pivotId;
    public $completedProcesses = [];
    public $trackingNumber;
    public $title = 'create-request';

    public function render()
    {
        return view('livewire.welcome',[
            'documents' => Document::all(),
            'dir' => '/',
        ]);
    }

    public function track($code)
    {
        $this->request = Request::find($code);
        $this->selectedDocument = null;
        $this->title = 'view-request';

        $this->dispatch('close-modal', 'view-document');
        $this->dispatch('open-modal', 'tracking-modal');
    }

    public function createRequest(){
        $this->title = 'create-request';
        $this->selectedDocument = null;

        $this->dispatch('open-modal', 'request-modal');
    }

    public function viewDocumentProcess(Document $document, $pivotId){
        $this->selectedDocument = $document;
        $this->pivotId = $pivotId;
        $this->completedProcesses = RequestDocumentProcess::where('request_document_id', $pivotId)->pluck('document_process_id');

        $this->dispatch('open-modal', 'view-document');
    }

    public function submitForm()
    {
        if (!empty($this->trackingNumber)) {
            $this->track($this->trackingNumber);
        }
    }
}
