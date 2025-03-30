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
            <h2 class="text-xl font-bold mb-3">{{ $student->first_name }} {{ $student->last_name }} - Attendance Records</h2>
            <table class="min-w-full leading-normal border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-sm font-semibold text-gray-700">
                        <th class="px-3 py-2 border border-gray-300 text-left text-xs text-gray-600 uppercase">Date</th>
                        <th class="px-3 py-2 border border-gray-300 text-left text-xs text-gray-600 uppercase">Morning In</th>
                        <th class="px-3 py-2 border border-gray-300 text-left text-xs text-gray-600 uppercase">Morning Out</th>
                        <th class="px-3 py-2 border border-gray-300 text-left text-xs text-gray-600 uppercase">Afternoon In</th>
                        <th class="px-3 py-2 border border-gray-300 text-left text-xs text-gray-600 uppercase">Afternoon Out</th>
                        <th class="px-3 py-2 border border-gray-300 text-left text-xs text-gray-600 uppercase">Morning Status</th>
                        <th class="px-3 py-2 border border-gray-300 text-left text-xs text-gray-600 uppercase">Afternoon Status</th>
                        <th class="px-3 py-2 border border-gray-300 text-left text-xs text-gray-600 uppercase">Duty Hours</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-100 border-b">
                    @forelse($attendances as $attendance)
                        <tr class="border-t hover:bg-gray-100">
                            <td class="px-3 py-2 border border-gray-300 bg-white text-sm">{{ $attendance->date }}</td>
                            <td class="px-3 py-2 border border-gray-300 bg-white text-sm">{{ $attendance->morning_time_in ?? '--' }}</td>
                            <td class="px-3 py-2 border border-gray-300 bg-white text-sm">{{ $attendance->morning_time_out ?? '--' }}</td>
                            <td class="px-3 py-2 border border-gray-300 bg-white text-sm">{{ $attendance->afternoon_time_in ?? '--' }}</td>
                            <td class="px-3 py-2 border border-gray-300 bg-white text-sm">{{ $attendance->afternoon_time_out ?? '--' }}</td>
                            <td class="px-3 py-2 border border-gray-300 bg-white text-sm">
                                <span class="{{ $attendance->morning_status === 'Present' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $attendance->morning_status ?? 'Absent' }}
                                </span>
                            </td>
                            <td class="px-3 py-2 border border-gray-300 bg-white text-sm">
                                <span class="{{ $attendance->afternoon_status === 'Present' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $attendance->afternoon_status ?? 'Absent' }}
                                </span>
                            </td>
                            <td class="px-3 py-2 border border-gray-300 bg-white text-sm">{{ $attendance->duty_hours }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center border border-gray-300 px-4 py-2">No attendance records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <a href="{{ url('/admin/studentsList') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Back to Student List
            </a>
        </div>
    </body>
    </html>
</x-navigation>
