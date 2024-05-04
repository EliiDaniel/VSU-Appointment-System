<?php

namespace App\Livewire\Registrar;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $role = '';
    public $search = '';
    public $shownEntries = 5;
    public $sortBy = 'id';
    public $sortDir = 'ASC';
    public User $selectedUser;

    public function mount()
    {
        $this->selectedUser = User::first();
    }

    public function render()
    {
        return view('livewire.registrar.users', [
            'users' => User::search($this->search)
                        ->when($this->role !== '', function($query){
                            $query->where('role', $this->role);
                        })
                        ->orderBy($this->sortBy, $this->sortDir)
                        ->paginate($this->shownEntries),
        ]);
    }
    
    public function showUser(User $user){
        $this->selectedUser = $user;

        $this->dispatch('open-modal', 'view-user');
    }

    public function setSortBy($col){
        $this->sortDir = ($this->sortBy === $col) ? (($this->sortDir == 'DESC') ? 'ASC' : 'DESC') : 'ASC';
        $this->sortBy = ($this->sortBy === $col) ? $this->sortBy : $col;
    }

    //Updates on page when shown entries is updated
    public function updatedShownEntries()
    {
        $this->resetPage();
    }

    public function updatedRole()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
}
