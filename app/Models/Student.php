<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
