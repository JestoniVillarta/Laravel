<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;


class StudentController extends Controller
{
    // Display the StudentsList.blade.php
    public function index()
    {
        try {
            $students = Student::all();
            return view('admin.studentsList', compact('students'));

        } catch (Exception $e) {
            Log::error('Error fetching students: ' . $e->getMessage());
            return back()->withErrors('Unable to fetch students list at this time.');
        }
    }



    public function store(Request $request)
    {
        // Validate the incoming request data
        try {
            $validatedData = $request->validate([
                'student_id' => 'required|unique:student_tbl,student_id', // Ensure student_id is unique
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'gender' => 'required|in:Male,Female,Other', // Validate gender options
                'contact' => 'required|string|min:10|max:15', // Ensure proper contact length
                'address' => 'required|string|max:500',
            ]);
            
            // Use mass assignment (instead of manually assigning each attribute)
            $student = Student::create($validatedData);
            
            // Return JSON success response for AJAX handling
            return response()->json([
                'status' => 'success',
                'message' => 'Student added successfully!',
                'student' => $student
            ]);
            
        } catch (ValidationException $e) {
            // Return validation errors as JSON
            return response()->json([
                'status' => 'error',
                'errors' => $e->errors()
            ], 422);
            
        } catch (QueryException $e) {
            // Check if the error is a duplicate entry error
            if ($e->getCode() === '23000') { // Adjust based on your database
                Log::error('Duplicate student ID error: ' . $e->getMessage());
                return response()->json([
                    'status' => 'error',
                    'errors' => ['student_id' => ['The student ID is already in use. Please use a different ID.']]
                ], 422);
            }
            
            Log::error('Error adding student: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while trying to add the student.'
            ], 500);
            
        } catch (Exception $e) {
            Log::error('General error adding student: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while trying to add the student.'
            ], 500);
        }
    }

    public function edit(int $id)
    {
        $student = Student::findOrFail($id);
        return view('admin.edit', compact('student'));
    }




// Update student
public function update(Request $request, $id)
{
    $request->validate([
        'student_id' => 'required|unique:student_tbl,student_id,'.$id,
        'first_name' => 'required',
        'last_name' => 'required',
        'gender' => 'required',
        'contact' => 'required',
        'address' => 'required',
    ]);

    Student::findOrFail($id)->update($request->all());

    return redirect()->route('admin.studentsList')
        ->with('success', 'Student updated successfully');
}



public function destroy(int $id)
{
    Student::findOrFail($id)->delete();

    return redirect()->route('admin.studentsList')
        ->with('success', 'Student deleted successfully');

}

}
