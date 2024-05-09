<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrarsController extends Controller
{
    public function index()
    {
        return view('registrar.index');
    }

    public function users(Request $request)
    {
        $userId = $request->query('user_id');

        return view('registrar.users', ['userId' => $userId]);
    }
    
    public function documents()
    {
        return view('registrar.documents');
    }
    
    public function requests(Request $request)
    {
        $trackingCode = $request->query('tracking_code');

        return view('registrar.requests', ['trackingCode' => $trackingCode]);
    }
    
    public function schedules()
    {
        return view('registrar.schedules');
    }
    
    public function notifications(Request $request)
    {
        $referenceNo = $request->query('reference_no');

        return view('registrar.notifications', ['referenceNo' => $referenceNo]);
    }
}
