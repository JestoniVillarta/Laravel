<x-navigation>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attendance Records</title>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: none;
            margin-top: 30px;
        }

        .card-title {
            color: #333;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
        }

        .table th {
            background-color: #f1f5f9;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table td {
            font-size: 0.9rem;
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        .status-present {
            color: #198754;
            font-weight: 500;
        }

        .status-absent {
            color: #dc3545;
            font-weight: 500;
        }

        .back-button {
            background-color: #0d6efd;
            padding: 8px 20px;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background-color: #0b5ed7;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .table-responsive {
            border-radius: 5px;
            overflow: hidden;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .card {
                margin-top: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <div class="card">
            <div class="card-body p-4">
                <h2 class="card-title fw-bold mb-4">{{ $student->first_name }} {{ $student->last_name }} - Attendance Records</h2>
                <div class="table-responsive mb-3">
                    <table class="table table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Morning In</th>
                                <th>Morning Out</th>
                                <th>Afternoon In</th>
                                <th>Afternoon Out</th>
                                <th>Morning Status</th>
                                <th>Afternoon Status</th>
                                <th>Duty Hours</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                            $totalDutyHours = 0;
                        @endphp


                            @forelse($attendances as $attendance)

                            @php
                            // Add current day's duty hours to total
                            $totalDutyHours += (float) $attendance->duty_hours;
                        @endphp

                                <tr>
                                    <td>{{ $attendance->date }}</td>
                                    <td>{{ $attendance->morning_time_in ?? '--' }}</td>
                                    <td>{{ $attendance->morning_time_out ?? '--' }}</td>
                                    <td>{{ $attendance->afternoon_time_in ?? '--' }}</td>
                                    <td>{{ $attendance->afternoon_time_out ?? '--' }}</td>
                                    <td>
                                        <span class="{{ $attendance->morning_status === 'Present' ? 'status-present' : 'status-absent' }}">
                                            {{ $attendance->morning_status ?? 'Absent' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="{{ $attendance->afternoon_status === 'Present' ? 'status-present' : 'status-absent' }}">
                                            {{ $attendance->afternoon_status ?? 'Absent' }}
                                        </span>
                                    </td>
                                    <td>{{ $attendance->duty_hours }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-3">No attendance records found.</td>
                                </tr>
                            @endforelse



                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ url('/admin/studentsList') }}" class="btn btn-primary text-white">
                            <i class="bi bi-arrow-left me-1"></i> Back to Student List
                        </a>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="me-2 mb-0">Total Duty:</label>
                        <span class="fw-bold">{{ number_format($totalDutyHours, 2) }}</span>
                    </div>
                </div>

            </div>
        </div>
    </div>


</body>
</html>

    </x-navigation>
