

<x-Navigation>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Student List</title>
        <script src="https://cdn.tailwindcss.com"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const modal = document.getElementById("successModal");
                if (modal) {
                    setTimeout(() => {
                        modal.classList.add("opacity-0", "transition-opacity", "duration-1000");
                        setTimeout(() => modal.style.display = "none", 1000);
                    }, 1000);
                }
            });
        </script>
        
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
                <h2 class="text-lg font-semibold">Student List</h2>

                <a href="/Add_student">
                    <button class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">
                        Add Student
                    </button>
                </a>
            </div>

            <!-- Search Input -->
            <div class="w-full flex justify-end mb-4">
                <div class="relative w-full sm:w-64">
                    <input type="text"
                        class="border border-gray-300 block w-full bg-gray-100 text-sm text-gray-600 py-2 px-4 pl-10 rounded-lg"
                        placeholder="Search">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M508.874 478.708L360.142 329.976c28.21-34.827 45.191-79.103 45.191-127.309C405.333 90.917 314.416 0 202.666 0S0 90.917 0 202.667s90.917 202.667 202.667 202.667c48.206 0 92.482-16.982 127.309-45.191l148.732 148.732c4.167 4.165 10.919 4.165 15.086 0l15.081-15.082c4.165-4.166 4.165-10.92-.001-15.085zM202.667 362.667c-88.229 0-160-71.771-160-160s71.771-160 160-160 160 71.771 160 160-71.771 160-160 160z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Student List Table -->
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
				<div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
					<table class="min-w-full leading-normal">
                    <thead>
                        <tr class="bg-gray-200 text-sm font-semibold text-gray-700">
                       
                            <th class="px-5 py-3 border-b- border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Student ID</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Full Name</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Gender</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Contact</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Address</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Action</th>
                            

                        </tr>
                    </thead>
                    <tbody class="bg-gray-100 border-b">
                        @foreach($all_students as $student)
                            <tr class="border-t hover:bg-gray-100">
                        
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $student->student_id }}</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $student->first_name }} {{ $student->last_name }}</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $student->gender }}</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $student->contact }}</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $student->address }}</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <a href="{{ url('/edit_student/'.$student->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                    <span class="mx-2">|</span>
                                    <a href="{{ url('/delete_student/'.$student->id) }}" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>

                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        </div>

    </body>

    </html>
</x-Navigation>
