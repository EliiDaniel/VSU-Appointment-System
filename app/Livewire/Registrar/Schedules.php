<?php

namespace App\Livewire\Registrar;

use Livewire\Component;
use App\Models\Schedule;
use App\Models\BlockedDate;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Schedules extends Component
{
    use WithPagination;
    use Actions;

    public $search = '';
    public $shownEntries = 5;
    public $sortBy = 'id';
    public $sortDir = 'ASC';
    public $title = 'view-schedule';
    public Schedule $schedule;
    public $minTime;
    public $maxTime;
    public $blockedDate;
    public $selectedDays;
    public $dayNames;
    public $state;

    public function mount()
    {
        $this->schedule = Schedule::first();
        $this->minTime = $this->schedule->min_time;
        $this->maxTime = $this->schedule->max_time;
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
        $this->state = ([
            'block_date' => null,
        ]);
    }

    public function sessionNotif($session)
    {
        $this->notification([
            'title'       => $session,
            'icon'        => 'success'
        ]);
    }

    public function blockDate()
    {
        $this->validate([
            'state.block_date' => 'required|date',
        ]);

        $this->dialog()->confirm([
            'title'       => 'Add new blocked date?',
            'icon'        => 'warning',
            'method'      => 'confirmCreateBlockDate',
        ]);
    }

    public function confirmCreateBlockDate()
    {
        BlockedDate::create([
            'date' => $this->state['block_date'],
        ]);

        $this->notification([
            'title'       => 'Blocked date successfully!',
            'icon'        => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.registrar.schedules', [
            'blocked_dates' => BlockedDate::search($this->search)
                            ->orderBy($this->sortBy, $this->sortDir)
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
    
    public function deleteBlockedDate(BlockedDate $blocked_date){
        $blocked_date->delete();
        $this->notification([
            'title'       => 'Blocked Date deleted!',
            'icon'        => 'success'
        ]);
    }
    
    public function updatedShownEntries()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
}
