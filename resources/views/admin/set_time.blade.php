<x-navigation>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Set Attendance Time</title>
        <script src="https://cdn.tailwindcss.com"></script>

    </head>


    <body class="bg-gray-100 p-6">

        <div class="bg-white p-6 rounded-lg shadow-md w-full">

            <div class="header-container mb-4">
                <h3 class="text-xl font-semibold text-gray-800">Set Attendance Time</h3>
            </div>

            <div class=" flex justify-center items-center   rounded-lg p-6  flex-col">

                <div class="content-container flex justify-center items-center shadow-above   rounded-lg p-6  flex-col shadow-xl   w-2/4 ">


                    <div class="form_wrapper ">
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




                                <div class="flex justify-center items-center  p-4 rounded-lg  w-60 mx-auto">
                                    <p class="text-xl font-semibold text-gray-700">MORNING</p>
                                </div>


                                <div class="flex items-center justify-end">




                                    <div class="flex items-center justify-between">
                                        <label for="morning_time_in" class="text-gray-700 mr-2"> Time In:</label>
                                        <input type="time" id="morning_time_in" name="morning_time_in" value="{{ old('morning_time_in', $morning_time_in ?? '') }}" required class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                                    </div>
                                    <div class="flex items-center ">
                                        <label for="morning_time_in_end" class="text-gray-700 mx-4 font-bold">&mdash;</label>

                                        <input type="time" id="morning_time_in_end" name="morning_time_in_end" value="{{ old('morning_time_in_end', $morning_time_in_end ?? '') }}" required class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                                    </div>


                                </div>

                                <!-- Morning Time Out and End -->

                                <div class="flex items-center justify-end">

                                    <div class="flex items-center justify-between">
                                        <label for="morning_time_out" class="text-gray-700 mr-2">Time Out:</label>
                                        <input type="time" id="morning_time_out" name="morning_time_out" value="{{ old('morning_time_out', $morning_time_out ?? '') }}" required class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                                    </div>

                                    <div class="flex items-center ">
                                        <label for="morning_time_in_end" class="text-gray-700 mx-4 font-bold">&mdash;</label>
                                        <input type="time" id="morning_time_out_end" name="morning_time_out_end" value="{{ old('morning_time_out_end', $morning_time_out_end ?? '') }}" required class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                                    </div>

                                </div>



                                <br>
                                <br>



                                <div class="flex justify-center items-center  p-4 rounded-lg  w-60 mx-auto">
                                    <p class="text-xl font-semibold text-gray-700">AFTERNOON</p>
                                </div>

                                <!-- Afternoon Time In and End -->
                                <div class="flex items-center  justify-end">
                                    <div class="flex items-center justify-between">
                                        <label for="afternoon_time_in" class="text-gray-700 mr-2">Time In:</label>
                                        <input type="time" id="afternoon_time_in" name="afternoon_time_in" value="{{ old('afternoon_time_in', $afternoon_time_in ?? '') }}" required class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                                    </div>
                                    <div class="flex items-center ">
                                        <label for="morning_time_in_end" class="text-gray-700 mx-4 font-bold">&mdash;</label>
                                        <input type="time" id="afternoon_time_in_end" name="afternoon_time_in_end" value="{{ old('afternoon_time_in_end', $afternoon_time_in_end ?? '') }}" required class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                                    </div>
                                </div>

                                <!-- Afternoon Time Out and End -->
                                <div class="flex items-center justify-end">
                                    <div class="flex items-center justify-between">
                                        <label for="afternoon_time_out" class="text-gray-700 mr-2">Time Out:</label>
                                        <input type="time" id="afternoon_time_out" name="afternoon_time_out" value="{{ old('afternoon_time_out', $afternoon_time_out ?? '') }}" required class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                                    </div>
                                    <div class="flex items-center">
                                        <label for="morning_time_in_end" class="text-gray-700 mx-4 font-bold">&mdash;</label>
                                        <input type="time" id="afternoon_time_out_end" name="afternoon_time_out_end" value="{{ old('afternoon_time_out_end', $afternoon_time_out_end ?? '') }}" required class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end mt-6">
                                <button type="submit" class="set_time bg-blue-500 text-white rounded-md px-4 py-2 hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">
                                    Set Time
                                </button>
                            </div>
                        </form>





                    </div>
                </div>
    </body>

    </html>
</x-navigation>