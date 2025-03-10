<?php

namespace App\Http\Controllers;

use App\Models\Time; // Import your Time model
use Illuminate\Http\Request;

class TimeController extends Controller
{
    // Method to display the form
    public function showForm()
    {
        // Fetch the first record for attendance times, if it exists
        $attendanceTime = Time::first();

        // Pass the attendance time data to the view
        return view('Set_time', [
            'morning_time_in' => $attendanceTime->morning_time_in ?? '',
            'morning_time_in_end' => $attendanceTime->morning_time_in_end ?? '',
            'morning_time_out' => $attendanceTime->morning_time_out ?? '',
            'morning_time_out_end' => $attendanceTime->morning_time_out_end ?? '',
            'afternoon_time_in' => $attendanceTime->afternoon_time_in ?? '',
            'afternoon_time_in_end' => $attendanceTime->afternoon_time_in_end ?? '',
            'afternoon_time_out' => $attendanceTime->afternoon_time_out ?? '',
            'afternoon_time_out_end' => $attendanceTime->afternoon_time_out_end ?? '',
        ]);
    }

    // Method to handle form submission
    public function setAttendanceTime(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
         'morning_time_in' => 'required|date_format:h:i',
'morning_time_in_end' => 'required|date_format:h:i',
'morning_time_out' => 'required|date_format:h:i',
'morning_time_out_end' => 'required|date_format:h:i A',
'afternoon_time_in' => 'required|date_format:h:i',
'afternoon_time_in_end' => 'required|date_format:h:i',
'afternoon_time_out' => 'required|date_format:h:i',
'afternoon_time_out_end' => 'required|date_format:h:i',

        ]);

        // Fetch the first record for attendance times
        $attendanceTime = Time::first();

        if ($attendanceTime) {
            // Update the existing record
            $attendanceTime->update($validatedData);
        } else {
            // Create a new record if none exists
            Time::create($validatedData);
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Attendance times have been set successfully.');
    }
}
