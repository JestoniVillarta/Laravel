<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Time;
use App\Models\Attendance;
use App\Models\Student;
use Carbon\Carbon;
use Exception;


class AttendanceController extends Controller

{
    public function showAttendanceButtons()
    {
        // Get current time in Asia/Manila timezone
        $current_time = Carbon::now('Asia/Manila');
    
        // Fetch time settings from the database
        $settings = Time::first();
    
        // Initialize button visibility
        $show_morning_in = false;
        $show_morning_out = false;
        $show_afternoon_in = false;
        $show_afternoon_out = false;
    
        if ($settings) {
            // Parse the start and end times using Carbon with updated column names
            $morning_in_start = Carbon::parse($settings->morning_time_in, 'Asia/Manila');
            $morning_in_end = Carbon::parse($settings->morning_time_in_end, 'Asia/Manila');
            $morning_out_start = Carbon::parse($settings->morning_time_out, 'Asia/Manila');
            $morning_out_end = Carbon::parse($settings->morning_time_out_end, 'Asia/Manila');
            $afternoon_in_start = Carbon::parse($settings->afternoon_time_in, 'Asia/Manila');
            $afternoon_in_end = Carbon::parse($settings->afternoon_time_in_end, 'Asia/Manila');
            $afternoon_out_start = Carbon::parse($settings->afternoon_time_out, 'Asia/Manila');
            $afternoon_out_end = Carbon::parse($settings->afternoon_time_out_end, 'Asia/Manila');
    
            // Determine button visibility based on the current time
            $show_morning_in = $current_time->between($morning_in_start, $morning_in_end);
            $show_morning_out = $current_time->between($morning_out_start, $morning_out_end);
            $show_afternoon_in = $current_time->between($afternoon_in_start, $afternoon_in_end);
            $show_afternoon_out = $current_time->between($afternoon_out_start, $afternoon_out_end);
        }
    
        return view('index', compact(
            'show_morning_in', 
            'show_morning_out', 
            'show_afternoon_in', 
            'show_afternoon_out'
        ));
    }

    public function searchAttendance(Request $request)
    {
        // Get the selected date (default to today if not set)
        $selectedDate = $request->input('date', Carbon::today()->toDateString());
    
        // Fetch attendance records for the selected date
        $attendances = Attendance::whereDate('date', $selectedDate)->get();
    
        // Return the view with filtered records
        return view('admin.attendance', compact('attendances', 'selectedDate'));
    }
    
    

    public function showAttendance()
    {
        try {
            // Get the current date
            $currentDate = Carbon::today('Asia/Manila')->toDateString();
            
            // Fetch all students
            $students = Student::all();

            // Loop through each student to check attendance
            foreach ($students as $student) {
                $attendance = Attendance::where('student_id', $student->student_id)
                    ->whereDate('date', $currentDate)
                    ->first();

                if (!$attendance) {
                    // If no attendance exists for today, mark them as absent
                    Attendance::create([
                        'student_id' => $student->student_id,
                        'name' => $student->first_name . ' ' . $student->last_name,
                        'gender' => $student->gender,
                        'date' => $currentDate,
                        'morning_status' => 'Absent',
                        'afternoon_status' => 'Absent',
                        'duty_hours' => '0.00',
                    ]);
                }
            }

            // Fetch attendance records for the current date
            $attendances = Attendance::whereDate('date', $currentDate)->get();

            return view('admin.attendance', compact('attendances'));
            
        } catch (Exception $e) {
            Log::error('Error fetching attendance records: ' . $e->getMessage());
            return back()->withErrors('Unable to fetch attendance records at this time.');
        }
    }

    


    public function submitAttendance(Request $request) {
        $request->validate(['student_id' => 'required|string']);
    
        // Get current date & time with timezone
        $current_time = Carbon::now('Asia/Manila')->format("h:i A"); 
        $current_date = Carbon::today('Asia/Manila')->toDateString();
        
        // Fetch student details
        $student = Student::where('student_id', $request->student_id)
            ->select('student_id', 'first_name', 'last_name', 'gender')
            ->first();
        
        if (!$student) {
            return back()->with('error', '❌ Error: Student not found.');
        }
    
        // Fetch existing attendance if available
        $attendance = Attendance::where('student_id', $student->student_id)
            ->where('date', $current_date)
            ->first();
    
        // Check if attendance exists before time-in
        if (!$attendance && ($request->has('morning_out') || $request->has('afternoon_out'))) {
            return back()->with('error', '❌ Error: You have not timed in today!');
        }
    
        // If no attendance exists, create it only when timing in
        if (!$attendance && ($request->has('morning_in') || $request->has('afternoon_in'))) {
            $attendance = Attendance::create([
                'student_id' => $student->student_id,
                'date' => $current_date,
                'name' => $student->first_name . ' ' . $student->last_name,
                'gender' => $student->gender
            ]);
        }
    
        // If still no attendance (meaning no time-in event), stop further processing
        if (!$attendance) {
            return back()->with('error', '❌ Error: No valid time-in, attendance not recorded.');
        }
    
        // Handle time-in and time-out events
        if ($request->has('morning_in') && !$attendance->morning_time_in) {
            $attendance->update(['morning_time_in' => $current_time, 'morning_status' => 'Present']);
        } elseif ($request->has('morning_out') && !$attendance->morning_time_out) {
            if (!$attendance->morning_time_in) {
                return back()->with('error', '❌ Error: You have not timed in today!');
            }
            $attendance->update(['morning_time_out' => $current_time]);
        } elseif ($request->has('afternoon_in') && !$attendance->afternoon_time_in) {
            $attendance->update(['afternoon_time_in' => $current_time, 'afternoon_status' => 'Present']);
        } elseif ($request->has('afternoon_out') && !$attendance->afternoon_time_out) {
            if (!$attendance->afternoon_time_in) {
                return back()->with('error', '❌ Error: You have not timed in today!');
            }
            $attendance->update(['afternoon_time_out' => $current_time]);
        } else {
            return back()->with('error', '❌ Error: Duplicate entry detected for today.');
        }
    
        // Re-fetch updated attendance data
        $attendance->refresh();
    
        // Compute total duty hours
        function computeTotalTime($time_in, $time_out) {
            if ($time_in && $time_out) {
                return (strtotime($time_out) - strtotime($time_in));
            }
            return 0;
        }
    
        $morning_seconds = computeTotalTime($attendance->morning_time_in, $attendance->morning_time_out);
        $afternoon_seconds = computeTotalTime($attendance->afternoon_time_in, $attendance->afternoon_time_out);
        
        $total_seconds = $morning_seconds + $afternoon_seconds;
        $total_hours = floor($total_seconds / 3600);
        $total_minutes = round(($total_seconds % 3600) / 60);
        $duty_hours = sprintf("%d.%02d", $total_hours, $total_minutes);
    
        // Update duty hours
        $attendance->update(['duty_hours' => $duty_hours]);
    
        return back()->with('success', '✅ Attendance recorded successfully!');
    }
    

}
