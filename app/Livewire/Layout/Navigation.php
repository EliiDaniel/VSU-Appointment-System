<?php

namespace App\Livewire\Layout;
use App\Livewire\Actions\Logout;
use App\Models\Notification;

use Livewire\Component;

class Navigation extends Component
{
    public $notifications;
    public $hasUnread = false;

    public function mount()
    {
        $this->notifications = auth()->user()->notifications()->latest()->take(5)->get();
        $this->hasUnread = $this->notifications->contains(function ($notification) {
            return is_null($notification->read_at);
        });
    }

    public function render()
    {
        return view('livewire.layout.navigation');
    }

    public function reloadNotifs()
    {
        $this->notifications = auth()->user()->notifications()->latest()->take(5)->get();
        $this->hasUnread = $this->notifications->contains(function ($notification) {
            return is_null($notification->read_at);
        });
    }

    public function logout(Logout $logout) {
        $logout();

        $this->redirect('/', navigate: true);
    }

    public function markAsRead(Notification $notification) {
        $notification->markAsRead();
        $this->notifications = auth()->user()->notifications()->latest()->take(5)->get();
        $this->hasUnread = $this->notifications->contains(function ($notif) {
            return is_null($notif->read_at);
        });
    }
}
