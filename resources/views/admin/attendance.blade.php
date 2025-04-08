<!-- resources/views/admin/attendanceList.blade.php -->

<x-navigation>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Attendance Records</title>

        <style>
            .custom-table th {
                background-color: #222d33;
                color: white;
                border: 2px solid #222d33;
            }

            .custom-table tr:hover {
                background-color: #f1f1f1;
            }

            .search-container input {
                width: 100%;
                padding: 0.5rem;
                border-radius: 500px;
            }

            .search-container .input-group {
                width: 100%;
            }

            .search-container .input-group-append {
                display: flex;
                justify-content: flex-end;
            }

            .search-container input[type="date"] {
                width: 150px;
            }

            .input-group {
                border-radius: 0.25rem;
            }

            /* Updated styles for 95% width and centering */
            .attendance-container {
                width: 95%;
                margin-top: 3rem;
                margin: 0 auto;
                padding: 1.5rem;
                box-sizing: border-box;

            }

            .table-container {

                overflow-y: auto;

                max-height: 70vh;

            }

            thead {
                position: sticky;
                top: 0;
                z-index: 1000;
             
            }

            @media (max-width: 768px) {
                .attendance-container {
                    padding: 1rem 0.5rem;
                }
            }
        </style>
    </head>

    <body>
        <!-- Using 95% width container centered with margin auto -->
        <div class="attendance-container bg-white rounded shadow-sm mt-4">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                <h2>Attendance Records</h2>

                <div class="d-flex align-items-center gap-3 ">
                    <!-- Date Picker Form -->
                    <form id="searchForm" action="{{ route('attendance.search') }}" method="GET">
                        <input type="date" name="date" id="datePicker" class="form-control" value="{{ request('date', date('Y-m-d')) }}">
                    </form>

                    <!-- Search Input -->
                    <input type="text" id="searchInput" class="form-control" placeholder="Search by ID or Name" autocomplete="off">
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const datePicker = document.getElementById('datePicker');

                    if (!datePicker.value) {
                        const today = new Date().toISOString().split('T')[0];
                        datePicker.value = today;
                    }

                    datePicker.addEventListener('change', function() {
                        document.getElementById('searchForm').submit();
                    });

                    document.getElementById("searchInput").addEventListener("input", function() {
                        let filter = this.value.toLowerCase().trim();
                        let rows = document.querySelectorAll("tbody tr");

                        rows.forEach(row => {
                            let studentID = row.cells[0].textContent.toLowerCase();
                            let fullName = row.cells[1].textContent.toLowerCase();

                            row.style.display = (studentID.includes(filter) || fullName.includes(filter)) ? "" : "none";
                        });
                    });
                });
            </script>

            <!-- Attendance Table -->
            <div class="table-container">
            <table class="table table-striped table-bordered table-hover mb-0 custom-table">
                     <thead class="table-dark">
                       
                            <tr>
                                <th class="text-center">Student ID</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Gender</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Morning In</th>
                                <th class="text-center">Morning Out</th>
                                <th class="text-center">Afternoon In</th>
                                <th class="text-center">Afternoon Out</th>
                                <th class="text-center">Total Duty Hours</th>
                                <th class="text-center">Morning Status</th>
                                <th class="text-center">Afternoon Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendances as $attendance)
                            <tr>
                                <td>{{ $attendance->student_id }}</td>
                                <td>{{ $attendance->name }}</td>
                                <td>{{ $attendance->gender }}</td>
                                <td>{{ $attendance->date }}</td>
                                <td>{{ $attendance->morning_time_in ?? '' }}</td>
                                <td>{{ $attendance->morning_time_out ?? '' }}</td>
                                <td>{{ $attendance->afternoon_time_in ?? '' }}</td>
                                <td>{{ $attendance->afternoon_time_out ?? '' }}</td>
                                <td>{{ $attendance->duty_hours ?? '0.00' }}</td>
                                <td>
                                    <span class="text-{{ $attendance->morning_status === 'Present' ? 'success' : 'danger' }}">
                                        {{ $attendance->morning_status ?? 'Absent' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-{{ $attendance->afternoon_status === 'Present' ? 'success' : 'danger' }}">
                                        {{ $attendance->afternoon_status ?? 'Absent' }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="11" class="text-center py-4">No attendance records available.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>

    </html>
</x-navigation>
