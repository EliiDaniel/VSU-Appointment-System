<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class RegistrarController extends Controller
{
    public function index()
    {
        return view('registrar.index');
    }

    public function users()
    {
        return view('registrar.users');
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
        ]);

        $request->session()->flash('status', 'user-updated');

        return redirect()->back();
    }
}
