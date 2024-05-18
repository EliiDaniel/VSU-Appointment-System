<?php

namespace App\Livewire\Cashier;

use App\Exports\TransactionsDataExport;
use Livewire\Component;
use App\Models\Request;
use App\Models\Notification;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    public $earnings;
    public $monthLabels;
    public $documents;
    public $documentLabels;
    public $export = [];

    public function mount()
    {
        $this->export = ([
            'transactions' => ([
                'start' => null,
                'end' => null,
            ]),
        ]);
        $this->earnings = Request::whereNotNull('paid_at')->get()->groupBy(function ($request) {
            return $request->created_at->format('F Y');
        })->map(function ($group) {
            return $group->sum('price');
        });

        $labels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $labels[] = $date->format('F Y');
        }
        $this->monthLabels = $labels;

        $requests = Request::whereNotNull('paid_at')->with('documents')->get();
        $groupedDocuments = [];
        foreach ($requests as $request) {
            foreach ($request->documents as $document) {
                $groupedDocuments[$document->name][] = $document;
            }
        }

        $counts = [];
        foreach ($groupedDocuments as $documentId => $documents) {
            $counts[$documentId] = count($documents);
        }

        $this->documents = $counts;
        $this->documentLabels = array_keys($counts);
    }

    public function render()
    {
        return view('livewire.cashier.index', [
            'approvedCount' => Request::whereNotNull('paid_at')->count(),
            'forApprovalCount' => Request::whereIn('status', ['Payment Approval', 'Awaiting Payment'])->count(),
            'notificationsCount' => Notification::where('user_id', auth()->user()->id)->count(),
        ]);
    }

    public function exportTransactions(){
        
        $validated = $this->validate([
            'export.transactions.start' => ['required','date'],
            'export.transactions.end' => ['required','date', 'after:export.transactions.start'],
        ], [
            'export.transactions.start' => 'Start date required',
            'export.transactions.end' => 'End date required and must be later than start',
        ]);
        session()->flash('status', 'Transactions Data Exported');
        return Excel::download(new TransactionsDataExport($validated['export']['transactions']['start'], $validated['export']['transactions']['end']), 'transactions-data' . '-' . $validated['export']['transactions']['start'] . '--' . $validated['export']['transactions']['end'] . '.xlsx');
    }
}
