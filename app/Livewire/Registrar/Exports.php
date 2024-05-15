<?php

namespace App\Livewire\Registrar;

use App\Exports\UsersDataExport;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Exports extends Component
{
    public function render()
    {
        return view('livewire.registrar.exports');
    }

    public function exportUsers(){
        return Excel::download(new UsersDataExport, 'users-data.xlsx');
    }
}
