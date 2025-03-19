<!-- resources/views/admin/attendanceList.blade.php -->

<x-navigation>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Attendance Records</title>
        <script src="https://cdn.tailwindcss.com"></script>

     



    </head>

    <body class="bg-gray-100 p-6">

    

        <div class="bg-white p-6 rounded-lg shadow-md w-full">
        <div class="flex justify-between items-center pb-4">
    <h2 class="text-lg font-semibold">Attendance Records</h2>

    <!-- Wrapper for date and search, aligned to the right -->
    <div class="flex items-center gap-4 ml-auto">
        <form id="searchForm" action="{{ route('attendance.search') }}" method="GET">
            <input type="date" name="date" id="datePicker" 
                class="border border-gray-300 rounded px-3 py-1"
                value="{{ request('date', date('Y-m-d')) }}">
        </form>

        <div class="relative w-full sm:w-64">
            <input type="text" id="searchInput"
                class="border border-gray-300 block w-full bg-gray-100 text-sm text-gray-600 py-2 px-4 pl-10 rounded-lg"
                placeholder="Search by ID or Name" autocomplete="off">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M508.874 478.708L360.142 329.976c28.21-34.827 45.191-79.103 45.191-127.309C405.333 90.917 314.416 0 202.666 0S0 90.917 0 202.667s90.917 202.667 202.667 202.667c48.206 0 92.482-16.982 127.309-45.191l148.732 148.732c4.167 4.165 10.919 4.165 15.086 0l15.081-15.082c4.165-4.166 4.165-10.92-.001-15.085zM202.667 362.667c-88.229 0-160-71.771-160-160s71.771-160 160-160 160 71.771 160 160-71.771 160-160 160z">
                    </path>
                </svg>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const datePicker = document.getElementById('datePicker');

        // Set the date picker to today's date if no date is specified
        if (!datePicker.value) {
            const today = new Date().toISOString().split('T')[0];
            datePicker.value = today;
        }

        datePicker.addEventListener('change', function() {
            document.getElementById('searchForm').submit();
        });

        document.getElementById("searchInput").addEventListener("input", function () {
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

        
          
            
        
            <!-- Attendance List Table -->
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr class="bg-gray-200 text-sm font-semibold text-gray-700">
                                <th style="background-color: #222d33;" class="px-3 py-3 border-2 border-gray-200  text-left text-xs text-white font-semibold text-gray-600 uppercase tracking-wider">Student ID</th>
                                <th style="background-color: #222d33;" class="px-3 py-3 border-2 border-gray-200  text-left text-xs text-white font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                                <th style="background-color: #222d33;" class="px-3 py-3 border-2 border-gray-200  text-left text-xs text-white font-semibold text-gray-600 uppercase tracking-wider">Gender</th>
                                <th style="background-color: #222d33;" class="px-3 py-3 border-2 border-gray-200  text-left text-xs text-white font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                                <th style="background-color: #222d33;" class="px-3 py-3 border-2 border-gray-200  text-left text-xs text-white font-semibold text-gray-600 uppercase tracking-wider">Morning Time In</th>
                                <th style="background-color: #222d33;" class="px-3 py-3 border-2 border-gray-200  text-left text-xs text-white font-semibold text-gray-600 uppercase tracking-wider">Morning Time Out</th>
                                <th style="background-color: #222d33;" class="px-3 py-3 border-2 border-gray-200  text-left text-xs text-white font-semibold text-gray-600 uppercase tracking-wider">Afternoon Time In</th>
                                <th style="background-color: #222d33;" class="px-3 py-3 border-2 border-gray-200  text-left text-xs text-white font-semibold text-gray-600 uppercase tracking-wider">Afternoon Time Out</th>
                                <th style="background-color: #222d33;" class="px-3 py-3 border-2 border-gray-200  text-left text-xs text-white font-semibold text-gray-600 uppercase tracking-wider">Duty Hours</th>
                                <th style="background-color: #222d33;" class="px-3 py-3 border-2 border-gray-200  text-left text-xs text-white font-semibold text-gray-600 uppercase tracking-wider">Morning Status</th>
                                <th style="background-color: #222d33;" class="px-3 py-3 border-2 border-gray-200  text-left text-xs text-white font-semibold text-gray-600 uppercase tracking-wider">Afternoon Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-100 border-b">
                            @forelse($attendances as $attendance)
                            <tr class="border-t hover:bg-gray-100">
                                <td class="px-5 py-3 border-2 border-gray-200 bg-white text-sm">{{ $attendance->student_id }}</td>
                                <td class="px-3 py-3 border-2 border-gray-200 bg-white text-sm">{{ $attendance->name }}</td>
                                <td class="px-3 py-3 border-2 border-gray-200 bg-white text-sm">{{ $attendance->gender }}</td>
                                <td class="px-3 py-3 border-2 border-gray-200 bg-white text-sm">{{ $attendance->date }}</td>
                                <td class="px-3 py-3 border-2 border-gray-200 bg-white text-sm">
                                    {{ $attendance && $attendance->morning_time_in ? $attendance->morning_time_in : '' }}
                                </td>
                                <td class="px-3 py-3 border-2 border-gray-200 bg-white text-sm">
                                    {{ $attendance && $attendance->morning_time_out ? $attendance->morning_time_out : '' }}
                                </td>
                                <td class="px-3 py-3 border-2 border-gray-200 bg-white text-sm">
                                    {{ $attendance && $attendance->afternoon_time_in ? $attendance->afternoon_time_in : '' }}
                                </td>
                                <td class="px-3 py-3 border-2 border-gray-200 bg-white text-sm">
                                    {{ $attendance && $attendance->afternoon_time_out ? $attendance->afternoon_time_out : '' }}
                                </td>

                                <td class="px-3 py-3 border-2 border-gray-200 bg-white text-sm">{{ $attendance->duty_hours ?? '0.00' }}</td>
                                <td class="px-3 py-3 border-2 border-gray-200 bg-white text-sm">
                                    <span class="{{ $attendance->morning_status === 'Present' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $attendance->morning_status ?? 'Absent' }}
                                    </span>
                                </td>
                                <td class="px-3 py-3 border-2 border-gray-200 bg-white text-sm">
                                    <span class="{{ $attendance->afternoon_status === 'Present' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $attendance->afternoon_status ?? 'Absent' }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="12" class="text-center py-4">No attendance records available.</td>
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