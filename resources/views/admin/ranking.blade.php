

<x-navigation>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Student Duty Hours Ranking</title>

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

            .ranking-container {
                width: 95%;
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

            .medal {
                font-size: 1.5rem;
                margin-right: 0.5rem;
            }

            .gold {
                color: gold;
            }

            .silver {
                color: silver;
            }

            .bronze {
                color: #cd7f32;
            }

            @media (max-width: 768px) {
                .ranking-container {
                    padding: 1rem 0.5rem;
                }
            }
        </style>
    </head>

    <body>
        <!-- Using 95% width container centered with margin auto -->
        <div class="ranking-container bg-white rounded shadow-sm mt-4">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                <h2>Student Duty Hours Ranking (All-Time)</h2>

                <div class="d-flex align-items-center">
                    <!-- Search Input -->
                    <input type="text" id="searchInput" class="form-control" placeholder="Search by ID or Name" autocomplete="off">
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Handle search functionality
                    document.getElementById("searchInput").addEventListener("input", function() {
                        let filter = this.value.toLowerCase().trim();
                        let rows = document.querySelectorAll("tbody tr");

                        rows.forEach(row => {
                            let studentID = row.cells[1].textContent.toLowerCase();
                            let fullName = row.cells[2].textContent.toLowerCase();

                            row.style.display = (studentID.includes(filter) || fullName.includes(filter)) ? "" : "none";
                        });
                    });
                });
            </script>

            <!-- Ranking Table -->
            <div class="table-container">
                <table class="table table-striped table-bordered table-hover mb-0 custom-table">
                    <thead class="table-dark">
                        <tr>
                            <th>Rank</th>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Total Duty Hours</th>
                            <th>Days Present</th>
                            <th>Average Hours/Day</th>
                            <th>First Attendance</th>
                            <th>Last Attendance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rankings as $index => $student)
                        <tr>
                            <td>
                                @if($index == 0)
                                    <span class="medal gold">🥇</span>{{ $index + 1 }}
                                @elseif($index == 1)
                                    <span class="medal silver">🥈</span>{{ $index + 1 }}
                                @elseif($index == 2)
                                    <span class="medal bronze">🥉</span>{{ $index + 1 }}
                                @else
                                    {{ $index + 1 }}
                                @endif
                            </td>
                            <td>{{ $student->student_id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->gender }}</td>
                            <td><strong>{{ number_format($student->total_duty_hours, 2) }}</strong></td>
                            <td>{{ $student->days_present }}</td>
                            <td>{{ number_format($student->average_hours_per_day, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($student->first_attendance)->format('M d, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($student->last_attendance)->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">No student records available.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </body>

    </html>
</x-navigation>
