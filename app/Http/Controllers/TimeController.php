<?php

namespace App\Http\Controllers;

use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class TimeController extends Controller
{
    public function showForm()
    {
        $attendanceTime = Time::first();

        return view('admin.set_time', [
            'morning_time_in' => $attendanceTime ? Carbon::parse($attendanceTime->morning_time_in)->format('H:i') : '',
            'morning_time_in_end' => $attendanceTime ? Carbon::parse($attendanceTime->morning_time_in_end)->format('H:i') : '',
            'morning_time_out' => $attendanceTime ? Carbon::parse($attendanceTime->morning_time_out)->format('H:i') : '',
            'morning_time_out_end' => $attendanceTime ? Carbon::parse($attendanceTime->morning_time_out_end)->format('H:i') : '',
            'afternoon_time_in' => $attendanceTime ? Carbon::parse($attendanceTime->afternoon_time_in)->format('H:i') : '',
            'afternoon_time_in_end' => $attendanceTime ? Carbon::parse($attendanceTime->afternoon_time_in_end)->format('H:i') : '',
            'afternoon_time_out' => $attendanceTime ? Carbon::parse($attendanceTime->afternoon_time_out)->format('H:i') : '',
            'afternoon_time_out_end' => $attendanceTime ? Carbon::parse($attendanceTime->afternoon_time_out_end)->format('H:i') : '',
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

        // Convert time to 12-hour format with AM/PM before saving
        foreach ($validatedData as $key => $time) {
            $validatedData[$key] = Carbon::parse($time)->format('h:i A');
        }

        $attendanceTime = Time::first();

        if ($attendanceTime) {
            $attendanceTime->update($validatedData);
        } else {
            Time::create($validatedData);
        }

        return redirect()->back()->with('success', 'Attendance times have been set successfully.');
    }
}
