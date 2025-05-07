<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class reportsController extends Controller
{
    public function index()
    {
        // Add any logic or data retrieval here if needed
        return view('admin.reports'); // This points to resources/views/admin/reports/index.blade.php
    }
}

