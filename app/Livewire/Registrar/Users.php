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

    public function mount()
    {
        $this->selectedUser = User::first();
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
