<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    // Define the table associated with the model (if it's not the plural of the model name)
    protected $table = 'attendance_tbl';

    // Specify the attributes that are mass assignable
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

    // Specify any attributes that should be cast to native types
    protected $casts = [
        'date' => 'date',
        'morning_time_in' => 'datetime:H:i',
        'morning_time_out' => 'datetime:H:i',
        'afternoon_time_in' => 'datetime:H:i',
        'afternoon_time_out' => 'datetime:H:i',
    ];

    // Accessors to ensure the times are formatted in 24-hour format when accessed
    public function getMorningTimeInAttribute($value)
    {
        return Carbon::parse($value)->format('H:i');
    }

    public function getMorningTimeOutAttribute($value)
    {
        return Carbon::parse($value)->format('H:i');
    }

    public function getAfternoonTimeInAttribute($value)
    {
        return Carbon::parse($value)->format('H:i');
    }

    public function getAfternoonTimeOutAttribute($value)
    {
        return Carbon::parse($value)->format('H:i');
    }

    // Mutators to ensure the times are stored in 24-hour format
    public function setMorningTimeInAttribute($value)
    {
        $this->attributes['morning_time_in'] = Carbon::createFromFormat('H:i', $value);
    }

    public function setMorningTimeOutAttribute($value)
    {
        $this->attributes['morning_time_out'] = Carbon::createFromFormat('H:i', $value);
    }

    public function setAfternoonTimeInAttribute($value)
    {
        $this->attributes['afternoon_time_in'] = Carbon::createFromFormat('H:i', $value);
    }

    public function setAfternoonTimeOutAttribute($value)
    {
        $this->attributes['afternoon_time_out'] = Carbon::createFromFormat('H:i', $value);
    }
}
