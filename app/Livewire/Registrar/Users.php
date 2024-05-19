<?php

namespace App\Livewire\Registrar;

use Livewire\Component;
use App\Models\User;
use App\Models\Credential;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use WireUi\Traits\Actions;

class Users extends Component
{
    use WithPagination;
    use Actions;

    public $role = '';
    public $search = '';
    public $shownEntries = 5;
    public $sortBy = 'id';
    public $sortDir = 'ASC';
    public User $selectedUser;
    public $user_state = [];

    public function mount()
    {
        $this->selectedUser = User::first();
        
        $this->user_state = ([
            'name' => null,
            'email' => null,
            'role' => null,
        ]);
    }

    public function userUpdated()
    {
        $this->notification([
            'title'       => 'User updated!',
            'icon'        => 'success'
        ]);
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

    public function update()
    {
        $this->validate([
            'user_state.name' => 'required|string|max:255',
            'user_state.email' => 'required|string|email|max:255|unique:users,email,' . $this->selectedUser->id,
        ]);

        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => 'Update user information?',
            'icon'        => 'warning',
            'acceptLabel' => 'Yes, save it',
            'method'      => 'confirmUpdate',
        ]);
    }

    public function confirmUpdate()
    {
        $this->selectedUser->update([
            'name' => $this->user_state['name'],
            'email' => $this->user_state['email'],
            'role' => $this->user_state['role'],
        ]);

        $this->notification([
            'title'       => 'User updated!',
            'icon'        => 'success'
        ]);
    }

    public function downloadCredentials()
    {
        $credentials = Credential::where('user_id', $this->selectedUser->id)->get();

        foreach ($credentials as $credential) {
            $ext = pathinfo($credential->file_name, PATHINFO_EXTENSION);

            $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . app('googleAccessToken'), 
                ])->get("https://www.googleapis.com/drive/v3/files/{$credential->file_id}?alt=media");

            if ($response->successful()) {
                // Ensure the directory exists
                $filePath = 'downloads/' . $credential->file_name . '.' . $ext;
                
                Storage::put($filePath, $response->body());

                return Storage::download($filePath);
            }
        }
    }

    public function deleteUser(User $user){
        $user->delete();
        $this->notification([
            'title'       => 'User deleted!',
            'icon'        => 'success'
        ]);
    }
    
    public function showUser(User $user){
        $this->selectedUser = $user;
        
        $this->user_state = ([
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
        ]);

        $this->dispatch('open-modal', 'view-user');
    }

    public function setSortBy($col){
        $this->sortDir = ($this->sortBy === $col) ? (($this->sortDir == 'DESC') ? 'ASC' : 'DESC') : 'ASC';
        $this->sortBy = ($this->sortBy === $col) ? $this->sortBy : $col;
    }

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
