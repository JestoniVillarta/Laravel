<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Time extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow the convention
    protected $table = 'time_tbl';

    // Define the fillable properties
    protected $fillable = [
        'morning_time_in',
        'morning_time_in_end',
        'morning_time_out',
        'morning_time_out_end',
        'afternoon_time_in',
        'afternoon_time_in_end',
        'afternoon_time_out',
        'afternoon_time_out_end',
    ];

    // Define the casts for time fields
    protected $casts = [
        'morning_time_in' => 'datetime:h:i A',
        'morning_time_in_end' => 'datetime:h:i A',
        'morning_time_out' => 'datetime:h:i A',
        'morning_time_out_end' => 'datetime:h:i A',
        'afternoon_time_in' => 'datetime:h:i A',
        'afternoon_time_in_end' => 'datetime:h:i A',
        'afternoon_time_out' => 'datetime:h:i A',
        'afternoon_time_out_end' => 'datetime:h:i A',
    ];
}
