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

        <!-- Success Message -->
        @if(session('success'))
        <div id="successModal" class="fixed inset-0 flex items-center justify-center bg-gray-100 bg-opacity-75">
            <div class="bg-green-100 text-green-700 px-6 py-4 rounded-md shadow-md text-center transition-opacity duration-1000 flex items-center">
                <svg class="w-6 h-6 text-green-700 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
        </div>
        @endif

        <div class="bg-white p-6 rounded-lg shadow-md w-full">
            <div class="flex justify-between items-center pb-4">
                <h2 class="text-lg font-semibold">Attendance Records</h2>
                <!-- Add controls or buttons if needed -->
            </div>

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