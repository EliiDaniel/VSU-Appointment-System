<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class TransactionsDataExport implements FromView, ShouldAutoSize
{
    use Exportable;

    private $transactions;
    private $startDate;
    private $endDate;

    public function __construct($start, $end) {
        // Ensure the dates are in the correct format
        $this->startDate = Carbon::parse($start);
        $this->endDate = Carbon::parse($end);

        // Retrieve users created between the start and end dates
        $this->transactions = Transaction::whereBetween('created_at', [$this->startDate, $this->endDate])->get();
    }

    public function view(): View
    {
        return view('exports.transactions', [
            'transactions' => $this->transactions,
            'start' => $this->startDate,
            'end' => $this->endDate,
        ]);
    }
}
