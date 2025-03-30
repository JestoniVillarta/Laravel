<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance;

class Student extends Model
{
    use HasFactory;

    protected $table = 'student_tbl'; // Custom table name

    protected $fillable = [
        'student_id',
        'first_name',
        'last_name',
        'gender',
        'contact',
        'address'
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($student) {
            $originalStudentId = $student->getOriginal('student_id'); // Old student_id
            $newStudentId = $student->student_id; // New student_id

            // Update the attendance records for this student
            Attendance::where('student_id', $originalStudentId)->update([
                'student_id' => $newStudentId,
                'name' => $student->first_name . ' ' . $student->last_name,
                'gender' => $student->gender
            ]);
        });
    }
}
