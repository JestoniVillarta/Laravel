<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model {
    use HasFactory;
    protected $table = 'attendance_tbl';
    protected $fillable = [
        'student_id',
        'name',
        'gender',
        'date',
        'morning_time_in',
        'morning_time_out',
        'afternoon_time_in',
        'afternoon_time_out',
        'morning_status',
        'afternoon_status',
        'duty_hours',
    ];
}
