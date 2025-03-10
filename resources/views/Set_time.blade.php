<x-Navigation>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Attendance Time</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="container mx-auto px-4 py-8">
    <div class="content-container bg-white shadow rounded-lg p-6">
        <div class="header-container mb-4">
            <h3 class="text-xl font-semibold text-gray-800">Set Attendance Time</h3>
        </div>

        <div class="form_wrapper">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('attendance.set-time') }}" method="post">
                @csrf
                <div class="time-container space-y-6">

                    <div class="time-group flex items-center space-x-4">
                        <label for="morning_time_in" class="text-gray-700">Morning Time In:</label>
                        <input type="time" id="morning_time_in" name="morning_time_in" value="{{ old('morning_time_in', $morning_time_in ?? '') }}" required class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                        <label for="morning_time_in_end" class="end-label text-gray-700">to</label>
                        <input type="time" id="morning_time_in_end" name="morning_time_in_end" value="{{ old('morning_time_in_end', $morning_time_in_end ?? '') }}" required class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                    </div>

                    <div class="time-group flex items-center space-x-4">
                        <label for="morning_time_out" class="text-gray-700">Morning Time Out:</label>
                        <input type="time" id="morning_time_out" name="morning_time_out" value="{{ old('morning_time_out', $morning_time_out ?? '') }}" required class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                        <label for="morning_time_out_end" class="end-label text-gray-700">to</label>
                        <input type="time" id="morning_time_out_end" name="morning_time_out_end" value="{{ old('morning_time_out_end', $morning_time_out_end ?? '') }}" required class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                    </div>

                    <div class="time-group flex items-center space-x-4">
                        <label for="afternoon_time_in" class="text-gray-700">Afternoon Time In:</label>
                        <input type="time" id="afternoon_time_in" name="afternoon_time_in" value="{{ old('afternoon_time_in', $afternoon_time_in ?? '') }}" required class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                        <label for="afternoon_time_in_end" class="end-label text-gray-700">to</label>
                        <input type="time" id="afternoon_time_in_end" name="afternoon_time_in_end" value="{{ old('afternoon_time_in_end', $afternoon_time_in_end ?? '') }}" required class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                    </div>

                    <div class="time-group flex items-center space-x-4">
                        <label for="afternoon_time_out" class="text-gray-700">Afternoon Time Out:</label>
                        <input type="time" id="afternoon_time_out" name="afternoon_time_out" value="{{ old('afternoon_time_out', $afternoon_time_out ?? '') }}" required class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                        <label for="afternoon_time_out_end" class="end-label text-gray-700">to</label>
                        <input type="time" id="afternoon_time_out_end" name="afternoon_time_out_end" value="{{ old('afternoon_time_out_end', $afternoon_time_out_end ?? '') }}" required class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                    </div>

                    <button type="submit" class="set_time bg-blue-500 text-white rounded-md px-4 py-2 hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">Set Time</button>

                </div>
            </form>
        </div>

    </div>
</div>
</body>
</html>
</x-Navigation>