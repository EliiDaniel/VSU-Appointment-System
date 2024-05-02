<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlockedDate;

class BlockedDatesController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $document = BlockedDate::create([
            'date' => $request->input('date'),
        ]);

        return redirect()->back();
    }
}
