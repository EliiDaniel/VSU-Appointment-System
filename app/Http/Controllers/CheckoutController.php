<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function successful()
    {
        return view('checkout-successful');
    }

    public function failed()
    {
        return view('checkout-failed');
    }
}
