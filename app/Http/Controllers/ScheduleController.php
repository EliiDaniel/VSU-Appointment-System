<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function update(Request $request)
{
    $validatedData = $request->validate([
        'daily_limit' => 'required|numeric',
        'min_time' => 'required|date_format:H:i', // Validate time format (24-hour)
        'max_time' => 'required|date_format:H:i',
        'min' => 'required', // Add appropriate validation rules for min date
        'max' => 'required', // Add appropriate validation rules for max date
        'days' => 'required|array', // Assuming days are selected as an array
    ]);

    $schedule = Schedule::first();

    $schedule->update([
        'daily_limit' => $validatedData['daily_limit'],
        'min_time' => $validatedData['min_time'],
        'max_time' => $validatedData['max_time'],
        'min' => $validatedData['min'],
        'max' => $validatedData['max'],
        'enabled_days' => json_encode($validatedData['days'])
    ]);


    $request->session()->flash('status', 'Success');
    return redirect()->back();
}
}
