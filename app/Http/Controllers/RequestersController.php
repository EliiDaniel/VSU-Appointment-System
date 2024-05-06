<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestersController extends Controller
{
    public function index()
    {
        return view('requester.index');
    }

    public function requests(Request $request)
    {
        $trackingCode = $request->query('tracking_code');

        return view('requester.requests', ['trackingCode' => $trackingCode]);
    }
}
