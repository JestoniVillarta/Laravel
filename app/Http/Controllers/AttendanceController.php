<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Time;
use App\Models\Attendance;
use App\Models\Student;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        // Retrieve time settings from the database
        // Assuming the table 'time_tbl' has columns: 'morning_in', 'morning_out', 'afternoon_in', 'afternoon_out'
        $settings = Time::find(1);
    
        // Get the current time and date in 24-hour format
        $current_time_24 = Carbon::now()->format('H:i');
        $current_date = Carbon::now()->format('Y-m-d');
    
        // Initialize button visibility to false
        $show_morning_in = false;
        $show_morning_out = false;
        $show_afternoon_in = false;
        $show_afternoon_out = false;
    
        // Check if the current time falls within the specified time ranges
        if ($settings) {
            // Assuming 'morning_in' and 'morning_out' are time strings in 'H:i' format
            if ($current_time_24 >= $settings->morning_in && $current_time_24 < $settings->morning_out) {
                $show_morning_in = true;
            }
            if ($current_time_24 >= $settings->morning_out && $current_time_24 < $settings->afternoon_in) {
                $show_morning_out = true;
            }
            if ($current_time_24 >= $settings->afternoon_in && $current_time_24 < $settings->afternoon_out) {
                $show_afternoon_in = true;
            }
            if ($current_time_24 >= $settings->afternoon_out) {
                $show_afternoon_out = true;
            }
        }
    
        // Return view with the necessary data
        return view('index', compact('show_morning_in', 'show_morning_out', 'show_afternoon_in', 'show_afternoon_out', 'current_date', 'current_time_24'));
    }

    public function store(Request $request)
    {
        // Validate the request to ensure student_id is provided
        $request->validate([
            'student_id' => 'required|string',
        ]);

        $student_id = $request->input('student_id');
        $student = Student::where('student_id', $student_id)->first();

        // Check if the student exists
        if (!$student) {
            return redirect()->back()->with('error', 'Student not found.');
        }

        $current_date = Carbon::now()->format('Y-m-d');
        $attendance = Attendance::where('student_id', $student_id)->where('DATE', $current_date)->first();

        // Create a new attendance record if none exists
        if (!$attendance) {
            $attendance = new Attendance();
            $attendance->STUDENT_ID = $student_id;
            $attendance->NAME = $student->FIRST_NAME . ' ' . $student->LAST_NAME;
            $attendance->GENDER = $student->GENDER;
            $attendance->DATE = $current_date;
            $attendance->save();
        }

        // Process attendance actions based on button clicked
        $current_time = Carbon::now()->format('H:i:s');

        if ($request->has('morning_in') && !$attendance->MORNING_TIME_IN) {
            $attendance->MORNING_TIME_IN = $current_time;
            $attendance->MORNING_STATUS = 'Present';
        } elseif ($request->has('morning_out') && !$attendance->MORNING_TIME_OUT) {
            if ($attendance->MORNING_TIME_IN) {
                $attendance->MORNING_TIME_OUT = $current_time;
            } else {
                return redirect()->back()->with('error', 'You have not timed in this morning.');
            }
        } elseif ($request->has('afternoon_in') && !$attendance->AFTERNOON_TIME_IN) {
            $attendance->AFTERNOON_TIME_IN = $current_time;
            $attendance->AFTERNOON_STATUS = 'Present';
        } elseif ($request->has('afternoon_out') && !$attendance->AFTERNOON_TIME_OUT) {
            if ($attendance->AFTERNOON_TIME_IN) {
                $attendance->AFTERNOON_TIME_OUT = $current_time;
            } else {
                return redirect()->back()->with('error', 'You have not timed in this afternoon.');
            }
        } else {
            return redirect()->back()->with('error', 'Duplicate entry detected for today.');
        }

        // Compute and update the total duty time
        $morning_seconds = $this->computeTotalTime($attendance->MORNING_TIME_IN, $attendance->MORNING_TIME_OUT);
        $afternoon_seconds = $this->computeTotalTime($attendance->AFTERNOON_TIME_IN, $attendance->AFTERNOON_TIME_OUT);

        $total_seconds = $morning_seconds + $afternoon_seconds;
        $total_hours = floor($total_seconds / 3600);
        $total_minutes = round(($total_seconds % 3600) / 60);
        $attendance->DUTY_HOURS = sprintf("%d.%02d", $total_hours, $total_minutes);

        // Save the updated attendance record
        $attendance->save();

        return redirect()->back()->with('success', 'Attendance recorded successfully!');
    }

    private function computeTotalTime($time_in, $time_out)
    {
        // Calculate the difference in seconds between time in and time out
        if ($time_in && $time_out) {
            $start = Carbon::parse($time_in);
            $end = Carbon::parse($time_out);
            return $end->diffInSeconds($start);
        }
        return 0;
    }
}