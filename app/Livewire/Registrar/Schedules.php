<?php

namespace App\Livewire\Registrar;

use Livewire\Component;
use App\Models\Schedule;
use App\Models\BlockedDate;
use Livewire\WithPagination;

class Schedules extends Component
{
    use WithPagination;

    public $search = '';
    public $shownEntries = 5;
    public $sortBy = 'id';
    public $sortDir = 'ASC';
    public $title = 'view-document';
    public Schedule $schedule;
    public $selectedDays;
    public $dayNames ;

    public function mount()
    {
        $this->schedule = Schedule::first();
        $this->selectedDays = [];
        $this->dayNames = [
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
            7 => 'Sunday',
        ];
    
    }

    public function render()
    {
        return view('livewire.registrar.schedules', [
            'blocked_dates' => BlockedDate::orderBy($this->sortBy, $this->sortDir)
                            ->paginate($this->shownEntries),
        ]);
    }

    public function setSortBy($col){
        $this->sortDir = ($this->sortBy === $col) ? (($this->sortDir == 'DESC') ? 'ASC' : 'DESC') : 'ASC';
        $this->sortBy = ($this->sortBy === $col) ? $this->sortBy : $col;
    }

    public function viewSchedule(){
        $this->selectedDays = json_decode($this->schedule->enabled_days);
        $this->title = "view-schedule";

        $this->dispatch('open-modal', 'schedule-modal');
    }
    
    public function createBlockedDate(){
        $this->title = "create-blocked-date";

        $this->dispatch('open-modal', 'schedule-modal');
    }
}
