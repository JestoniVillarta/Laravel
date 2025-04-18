<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class rankingController extends Controller
{
    public function studentsRanking()
    {
        // Query to get students ranked by total duty hours (all-time)
        $rankings = Attendance::select(
                'student_id',
                'name',
                'gender',
                DB::raw('SUM(duty_hours) as total_duty_hours'),
                DB::raw('COUNT(DISTINCT date) as days_present'),
                DB::raw('SUM(duty_hours) / COUNT(DISTINCT date) as average_hours_per_day'),
                DB::raw('MIN(date) as first_attendance'),
                DB::raw('MAX(date) as last_attendance')
            )
            ->where(function($query) {
                $query->where('morning_status', 'Present')
                      ->orWhere('afternoon_status', 'Present');
            })
            ->groupBy('student_id', 'name', 'gender')
            ->orderByDesc('total_duty_hours')
            ->get();

        return view('admin.ranking', compact('rankings'));
    }
}
