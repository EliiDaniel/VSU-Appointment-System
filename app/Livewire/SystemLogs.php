<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SystemLog;
use Livewire\WithPagination;

class SystemLogs extends Component
{
    use WithPagination;

    public $search = '';
    public $shownEntries = 5;
    public $sortBy = 'id';
    public $sortDir = 'ASC';
    public ?SystemLog $selectedLog;

    public function render()
    {
        return view('livewire.system-logs', [
            'logs' => SystemLog::search($this->search)
                        ->orderBy($this->sortBy, $this->sortDir)
                        ->paginate($this->shownEntries),
        ]);
    }

    public function viewLog(SystemLog $log){
        $this->selectedLog = $log;

        $this->dispatch('open-modal', 'log-modal');
    }

    public function setSortBy($col){
        $this->sortDir = ($this->sortBy === $col) ? (($this->sortDir == 'DESC') ? 'ASC' : 'DESC') : 'ASC';
        $this->sortBy = ($this->sortBy === $col) ? $this->sortBy : $col;
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
