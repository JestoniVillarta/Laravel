<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance</title>
    <script src="https://cdn.tailwindcss.com"></script>
 

</head>
<body class="bg-gray-100">

<div class="container mx-auto mt-10">

    <h1 class="text-3xl font-bold mb-5 text-center">TRAINEE ATTENDANCE SYSTEM</h1>


    <form action="{{ route('attendance') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        @csrf

        <input type="text" id="student_id" name="student_id" placeholder="ENTER YOUR ID:" required class="w-full p-3 mb-4 border rounded">

        @if(session('error'))
            <div class="bg-red-500 text-white p-3 mb-4 rounded">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="flex justify-center gap-4">

    @if ($show_morning_in)
        <button type="submit" name="morning_in" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Morning Time In</button>
    @endif

    @if ($show_morning_out)
        <button type="submit" name="morning_out" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Morning Time Out</button>
    @endif

    @if ($show_afternoon_in)
        <button type="submit" name="afternoon_in" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Afternoon Time In</button>
    @endif

    @if ($show_afternoon_out)
        <button type="submit" name="afternoon_out" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Afternoon Time Out</button>
    @endif
    
</div>
    </form>

</div>

</body>
</html>