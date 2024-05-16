<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class UsersDataExport implements FromView, ShouldAutoSize
{
    use Exportable;

    private $users;
    private $startDate;
    private $endDate;

    public function __construct($start, $end) {
        // Ensure the dates are in the correct format
        $this->startDate = Carbon::parse($start);
        $this->endDate = Carbon::parse($end);

        // Retrieve users created between the start and end dates
        $this->users = User::whereBetween('created_at', [$this->startDate, $this->endDate])->get();
    }

    public function view(): View
    {
        return view('exports.users', [
            'users' => $this->users,
            'start' => $this->startDate,
            'end' => $this->endDate,
        ]);
    }
}
