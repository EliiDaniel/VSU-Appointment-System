<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashiersController extends Controller
{
    public function index()
    {
        return view('cashier.index');
    }
}
