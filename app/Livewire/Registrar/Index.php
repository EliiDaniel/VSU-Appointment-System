<?php

namespace App\Livewire\Registrar;

use Livewire\Component;
use App\Models\User;
use App\Models\Request;
use App\Models\Document;
use App\Models\BlockedDate;
use App\Models\Notification;
use Carbon\Carbon;

class Index extends Component
{
    public $users;
    public $requests;
    public $requestsPerDay;
    public $dayLabels;

    public function mount()
    {
        $this->users = [
            'admin' => User::where('role', 'admin')->count(),
            'registrar' => User::where('role', 'registrar')->count(),
            'cashier' => User::where('role', 'cashier')->count(),
            'requester' => User::where('role', 'requester')->count(),
            'confirmation' => User::where('role', 'confirmation')->count(),
        ];

        $this->requests = [
            'pending_approval' => Request::where('status', 'Pending Approval')->count(),
            'in_progress' => Request::where('status', 'In Progress')->count(),
            'payment_approval' => Request::where('status', 'Payment Approval')->count(),
            'awaiting_payment' => Request::where('status', 'Awaiting Payment')->count(),
            'for_collection' => Request::where('status', 'Ready for Collection')->count(),
            'completed' => Request::where('status', 'Completed')->count(),
            'canceled' => Request::where('status', 'Canceled')->count(),
        ];

        $endDate = Carbon::now();
        $startDate = Carbon::now()->subDays(6);

        $requestsPerDay = Request::whereBetween('created_at', [$startDate, $endDate])->get();
        $this->requestsPerDay = $requestsPerDay->groupBy(function ($requestsPerDay) {
            return $requestsPerDay->created_at->format('l');
        })->map(function ($group) {
            return $group->count();
        });

        $labels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('l');
        }

        $this->dayLabels = $labels;
    }

    public function render()
    {
        return view('livewire.registrar.index', [
            'usersCount' => User::count(),
            'requestsCount' => Request::count(),
            'documentsCount' => Document::count(),
            'blockedDatesCount' => BlockedDate::count(),
            'notificationsCount' => Notification::where('user_id', auth()->user()->id)->count(),
        ]);
    }
}
