<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrarsController extends Controller
{
    public function index()
    {
        return view('registrar.index');
    }

    public function users()
    {
        return view('registrar.users');
    }
    
    public function documents()
    {
        return view('registrar.documents');
    }
    
    public function requests()
    {
        return view('registrar.requests');
    }
    
    public function schedules()
    {
        return view('registrar.schedules');
    }
}
