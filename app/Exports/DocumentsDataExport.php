<?php

namespace App\Exports;

use App\Models\Document;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class DocumentsDataExport implements FromView, ShouldAutoSize
{
    use Exportable;

    private $documents;
    private $startDate;
    private $endDate;

    public function __construct($start, $end) {
        // Ensure the dates are in the correct format
        $this->startDate = Carbon::parse($start);
        $this->endDate = Carbon::parse($end);

        // Retrieve users created between the start and end dates
        $this->documents = Document::whereBetween('created_at', [$this->startDate, $this->endDate])->get();
    }

    public function view(): View
    {
        return view('exports.documents', [
            'documents' => $this->documents,
            'start' => $this->startDate,
            'end' => $this->endDate,
        ]);
    }
}
