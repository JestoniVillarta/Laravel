
    <x-Navigation>

    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-400 to-purple-500 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-lg bg-white rounded-lg shadow-lg p-8 mx-auto">
        <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Register Student</h2>

        <form action="{{ route('store') }}" method="post">
        @csrf
            <div class="mb-4">
                <label for="student_id" class="block text-gray-700 font-medium mb-2">Student ID</label>
                <input type="text" name="student_id" id="student_id" placeholder="Enter Student ID" class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400">
            </div>
            <div class="mb-4">
                <label for="first_name" class="block text-gray-700 font-medium mb-2">First Name</label>
                <input type="text" name="first_name" id="first_name" placeholder="Enter First Name" class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400">
            </div>
            <div class="mb-4">
                <label for="last_name" class="block text-gray-700 font-medium mb-2">Last Name</label>
                <input type="text" name="last_name" id="last_name" placeholder="Enter Last Name" class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400">
            </div>
            <div class="mb-4">
                <label for="gender" class="block text-gray-700 font-medium mb-2">Gender</label>
                <select name="gender" id="gender" class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="contact" class="block text-gray-700 font-medium mb-2">Contact</label>
                <input type="text" name="contact" id="contact" placeholder="Enter Contact Number" class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400">
            </div>
            <div class="mb-4">
                <label for="address" class="block text-gray-700 font-medium mb-2">Address</label>
                <input type="text" name="address" id="address" placeholder="Enter Address" class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400">
            </div>
            <div class="mt-6">
                <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-md transition" type="submit">Register</button>
                <a href="/StudentsList" class="block mt-3 text-center bg-gray-400 hover:bg-gray-500 text-white font-bold py-3 rounded-md transition">Back</a>
            </div>
        </form>
    </div>
</body>
</html>



</x-Navigation>