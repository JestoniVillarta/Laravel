<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $filter = $request->input('filter', 'weekly'); // Default is weekly

        $today = Carbon::now()->toDateString();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Count Present and Absent only in the morning for today
        $present = Attendance::whereDate('created_at', $today)
            ->where('morning_status', 'Present')
            ->count();

        $absent = Attendance::whereDate('created_at', $today)
            ->where('morning_status', 'Absent')
            ->count();

        $totalStudents = Student::count();

        // Calculate the monthly attendance rate correctly
        // First, get all days in the current month that have attendance records
        $daysWithAttendance = Attendance::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->distinct()
            ->pluck('created_at')
            ->map(function($date) {
                return Carbon::parse($date)->format('Y-m-d');
            })
            ->unique();

        $totalPossibleAttendances = $daysWithAttendance->count() * $totalStudents;

        // Only count if we have attendance days
        if ($totalPossibleAttendances > 0) {
            $totalPresent = Attendance::whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)
                ->where('morning_status', 'Present')
                ->count();

            $attendanceRate = ($totalPresent / $totalPossibleAttendances) * 100;
        } else {
            $attendanceRate = 0;
        }

        // Determine range based on filter
        if ($filter == 'monthly') {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        } else { // weekly
            $startDate = Carbon::now()->subDays(6);
            $endDate = Carbon::now();
        }

        $dates = [];
        $presentData = [];
        $absentData = [];

        for ($date = clone $startDate; $date->lte($endDate); $date->addDay()) {
            $formattedDate = $date->format('M d');

            // Count Present in the morning only
            $presentCount = Attendance::whereDate('created_at', $date->format('Y-m-d'))
                ->where('morning_status', 'Present')
                ->count();

            // Count Absent in the morning only
            $absentCount = Attendance::whereDate('created_at', $date->format('Y-m-d'))
                ->where('morning_status', 'Absent')
                ->count();

            $dates[] = $formattedDate;
            $presentData[] = $presentCount;
            $absentData[] = $absentCount;
        }

        return view('admin.dashboard', compact(
            'present',
            'absent',
            'totalStudents',
            'attendanceRate',
            'dates',
            'presentData',
            'absentData',
            'filter'
        ));
    }
}
