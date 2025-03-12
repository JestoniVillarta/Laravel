<?php

namespace App\Http\Controllers;

use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TimeController extends Controller
{
    public function showForm()
    {
        $attendanceTime = Time::first();

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

    public function setAttendanceTime(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'morning_time_in' => 'required|date_format:H:i',
            'morning_time_in_end' => 'required|date_format:H:i|after:morning_time_in',
            'morning_time_out' => 'required|date_format:H:i',
            'morning_time_out_end' => 'required|date_format:H:i|after:morning_time_out',
            'afternoon_time_in' => 'required|date_format:H:i',
            'afternoon_time_in_end' => 'required|date_format:H:i|after:afternoon_time_in',
            'afternoon_time_out' => 'required|date_format:H:i',
            'afternoon_time_out_end' => 'required|date_format:H:i|after:afternoon_time_out',
        ], [
            'morning_time_in_end.after' => 'Error: Morning time in end must be after morning time in.',
            'morning_time_out_end.after' => 'Error: Morning time out end must be after morning time out.',
            'afternoon_time_in_end.after' => 'Error: Afternoon time in end must be after afternoon time in.',
            'afternoon_time_out_end.after' => 'Error: Afternoon time out end must be after afternoon time out.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $attendanceTime = Time::first();

        if ($attendanceTime) {
            $attendanceTime->update($validatedData);
        } else {
            Time::create($validatedData);
        }

        return redirect()->back()->with('success', 'Attendance times have been set successfully.');
    }
}
