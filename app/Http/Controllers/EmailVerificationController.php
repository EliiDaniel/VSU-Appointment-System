<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VerifiedEmail;

class EmailVerificationController extends Controller
{
    public function index()
    {
        return view('verification-complete');
    }

    public function verify(Request $request, $email)
    {
        VerifiedEmail::firstOrCreate(['email' => $email]);
        return redirect()->route('verification.complete');
    }
}
