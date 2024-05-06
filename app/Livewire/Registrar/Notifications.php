<?php

namespace App\Livewire\Registrar;

use Livewire\Component;
use App\Models\Notification;
use Livewire\WithPagination;


class Notifications extends Component
{
    use WithPagination;

    public $search = '';
    public $shownEntries = 5;
    public $sortBy = 'id';
    public $sortDir = 'ASC';
    public Notification $selectedNotification;

    public function mount()
    {
        $this->selectedNotification = Notification::first();
    }

    public function render()
    {
        return view('livewire.registrar.notifications', [
            'notifications' => Notification::search($this->search)
                        ->orderBy($this->sortBy, $this->sortDir)
                        ->paginate($this->shownEntries),
        ]);
    }

    public function showNotification(Notification $notification){
        $this->selectedNotification = $notification;

        $this->dispatch('open-modal', 'view-notification');
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
