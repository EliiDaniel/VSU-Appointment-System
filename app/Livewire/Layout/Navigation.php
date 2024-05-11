<?php

namespace App\Livewire\Layout;
use App\Livewire\Actions\Logout;
use App\Models\Notification;

use Livewire\Component;

class Navigation extends Component
{
    public function render()
    {
        return view('livewire.layout.navigation', [
            'notifications' => auth()->user()?->notifications()->latest()->take(5)->get(),
            'hasUnread' => auth()->user()?->notifications->whereNull('read_at')->count(),
        ]);
    }

    public function logout(Logout $logout) {
        $logout();

        $this->redirect('/', navigate: false);
    }

    public function markAsRead(Notification $notification) {
        $notification->markAsRead();
    }
}
