<?php

namespace App\Livewire\Requester;

use Livewire\Component;
use App\Models\Notification;
use Livewire\WithPagination;

class Notifications extends Component
{
    use WithPagination;

    public $search = '';
    public $read = '';
    public $type = '';
    public $shownEntries = 5;
    public $sortBy = 'id';
    public $sortDir = 'DESC';
    public ?Notification $selectedNotification;

    public function render()
    {
        return view('livewire.requester.notifications', [
            'notifications' => Notification::search($this->search)
                        ->where('user_id', auth()->user()->id)
                        ->when($this->read !== '', function($query){
                            if ($this->read === 'read') {
                                $query->whereNotNull('read_at');
                            } else {
                                $query->whereNull('read_at');
                            }
                        })
                        ->when($this->type !== '', function($query){
                            $query->search($this->type);
                        })
                        ->orderBy($this->sortBy, $this->sortDir)
                        ->paginate($this->shownEntries),
        ]);
    }

    public function viewNotification(Notification $notification){
        $this->selectedNotification = $notification;
        $this->selectedNotification->markAsRead();

        $this->dispatch('open-modal', 'notification-modal');
    }

    public function deleteNotification(Notification $notification){
        $notification->delete();
    }

    public function setSortBy($col){
        $this->sortDir = ($this->sortBy === $col) ? (($this->sortDir == 'DESC') ? 'ASC' : 'DESC') : 'ASC';
        $this->sortBy = ($this->sortBy === $col) ? $this->sortBy : $col;
    }

    public function updatedRead()
    {
        $this->resetPage();
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
