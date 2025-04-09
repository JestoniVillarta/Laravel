<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student; // Import the Student model
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
{
    $filter = $request->input('filter', 'weekly'); // Default is weekly

    $today = Carbon::now()->toDateString();
    $currentMonth = Carbon::now()->month;

    $presentMorning = Attendance::whereDate('created_at', $today)->where('morning_status', 'Present')->count();
    $presentAfternoon = Attendance::whereDate('created_at', $today)->where('afternoon_status', 'Present')->count();
    $absentMorning = Attendance::whereDate('created_at', $today)->where('morning_status', 'Absent')->count();
    $absentAfternoon = Attendance::whereDate('created_at', $today)->where('afternoon_status', 'Absent')->count();

    $presentStudents = Attendance::whereMonth('created_at', $currentMonth)
                                  ->where(function ($query) {
                                      $query->where('morning_status', 'Present')
                                            ->orWhere('afternoon_status', 'Present');
                                  })
                                  ->count();

    $totalStudents = Student::count();

    $attendanceRate = $totalStudents > 0 ? ($presentStudents / $totalStudents) * 100 : 0;

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

    for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
        $formattedDate = $date->format('M d');

        $presentCount = Attendance::whereDate('created_at', $date)
            ->where(function ($query) {
                $query->where('morning_status', 'Present')
                      ->orWhere('afternoon_status', 'Present');
            })
            ->count();

        $absentCount = Attendance::whereDate('created_at', $date)
            ->where(function ($query) {
                $query->where('morning_status', 'Absent')
                      ->orWhere('afternoon_status', 'Absent');
            })
            ->count();

        $dates[] = $formattedDate;
        $presentData[] = $presentCount;
        $absentData[] = $absentCount;
    }

    return view('admin.dashboard', compact(
        'presentMorning',
        'presentAfternoon',
        'absentMorning',
        'absentAfternoon',
        'totalStudents',
        'attendanceRate',
        'dates',
        'presentData',
        'absentData',
        'filter'
    ));
}

}
