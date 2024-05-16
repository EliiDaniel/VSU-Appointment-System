<?php

namespace App\Livewire\Registrar;

use App\Exports\DocumentsDataExport;
use App\Exports\RequestsDataExport;
use App\Exports\UsersDataExport;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Exports extends Component
{
    public $export = [];

    public function mount()
    {
        $this->export = ([
            'users' => ([
                'start' => null,
                'end' => null,
            ]),
            'requests' => ([
                'start' => null,
                'end' => null,
            ]),
            'documents' => ([
                'start' => null,
                'end' => null,
            ]),
        ]);
    }

    public function render()
    {
        return view('livewire.registrar.exports');
    }

    public function exportUsers(){
        
        $validated = $this->validate([
            'export.users.start' => ['required','date'],
            'export.users.end' => ['required','date', 'after:export.users.start'],
        ], [
            'export.users.start' => 'Start date required',
            'export.users.end' => 'End date required and must be later than start',
        ]);
        return Excel::download(new UsersDataExport($validated['export']['users']['start'], $validated['export']['users']['end']), 'users-data' . '-' . $validated['export']['users']['start'] . '--' . $validated['export']['users']['end'] . '.xlsx');
    }

    public function exportRequests(){
        
        $validated = $this->validate([
            'export.requests.start' => ['required','date'],
            'export.requests.end' => ['required','date', 'after:export.requests.start'],
        ], [
            'export.requests.start' => 'Start date required',
            'export.requests.end' => 'End date required and must be later than start',
        ]);
        return Excel::download(new RequestsDataExport($validated['export']['requests']['start'], $validated['export']['requests']['end']), 'requests-data' . '-' . $validated['export']['requests']['start'] . '--' . $validated['export']['requests']['end'] . '.xlsx');
    }

    public function exportDocuments(){
        
        $validated = $this->validate([
            'export.documents.start' => ['required','date'],
            'export.documents.end' => ['required','date', 'after:export.documents.start'],
        ], [
            'export.documents.start' => 'Start date required',
            'export.documents.end' => 'End date required and must be later than start',
        ]);
        return Excel::download(new DocumentsDataExport($validated['export']['documents']['start'], $validated['export']['documents']['end']), 'documents-data' . '-' . $validated['export']['documents']['start'] . '--' . $validated['export']['documents']['end'] . '.xlsx');
    }
}
