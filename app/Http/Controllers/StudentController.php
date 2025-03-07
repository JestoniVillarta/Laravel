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
       $data = $request->validate([
            'student_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'contact' => 'required',
            'address' => 'required',
        ]);

        
        $new_student = new Student;
        $new_student->student_id = $request->student_id;
        $new_student->first_name = $request->first_name;
        $new_student->last_name = $request->last_name;
        $new_student->gender = $request->gender;
        $new_student->contact = $request->contact;
        $new_student->address = $request->address;
        $new_student->save();



    
    
    }

  }

