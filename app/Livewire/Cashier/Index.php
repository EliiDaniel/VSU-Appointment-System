<?php

namespace App\Livewire\Cashier;

use Livewire\Component;
use App\Models\Request;
use App\Models\Notification;
use Carbon\Carbon;

class Index extends Component
{
    public $earnings;
    public $monthLabels;
    public $documents;
    public $documentLabels;

    public function mount()
    {
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
}
