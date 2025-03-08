<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Mo-display sa StudentsList.blade.php
    public function index()
    {
        $all_students = Student::all();
        return view('StudentsList', compact('all_students'));
    }

    // Mo-display sa Add_student.blade.php
    public function AddStudent()
    {
        return view('Add_student');
    }

    // Mo-save sa student data
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'student_id' => 'required', // Ensure student_id is unique
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Other', // Validate gender options
            'contact' => 'required|string|min:10|max:15', // Ensure proper contact length
            'address' => 'required|string|max:500',
        ]);
    
        // Use mass assignment (instead of manually assigning each attribute)
        Student::create($validatedData);
    
        // Redirect back to student list with a success message
        return redirect()->route('StudentsList')->with('success', 'Student added successfully!');
    }
    

  }

