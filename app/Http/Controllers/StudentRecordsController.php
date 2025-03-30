<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;

class StudentRecordsController extends Controller
{
    public function showStudentRecords($student_id)
    {
        // Fetch student details
        $student = Student::where('student_id', $student_id)->firstOrFail();
    
        // Fetch all attendance records for this student
        $attendances = Attendance::where('student_id', $student_id)
            ->orderBy('date', 'desc')
            ->get();
    
        // Return the view with student and attendance records
        return view('admin.student-records', compact('student', 'attendances'));
    }
    
    
}

