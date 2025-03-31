<x-navigation>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Student List</title>


        <script>
            document.addEventListener("DOMContentLoaded", function() {
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


            </div>

            <!-- Search Input -->
            <div class="w-full flex justify-end mb-4 gap-4">

                <!-- Gender Dropdown Filter -->
                <div>
                    <select id="genderFilter"
                        class="border border-gray-300 block bg-gray-100 text-sm text-gray-600 py-2 px-4 rounded-lg">
                        <option value="">All Genders</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <script>
                    document.getElementById("genderFilter").addEventListener("change", function() {
                        let genderValue = this.value.trim().toLowerCase();
                        let rows = document.querySelectorAll("tbody tr");

                        rows.forEach(row => {
                            let gender = row.cells[2].textContent.trim().toLowerCase(); // Ensure no extra spaces

                            row.style.display = (genderValue === "" || gender === genderValue) ? "" : "none";
                        });
                    });
                </script>

                <div class="relative w-full sm:w-64">
                    <input type="text" id="searchInput"
                        class="border border-gray-300 block w-full bg-gray-100 text-sm text-gray-600 py-2 px-4 pl-10 rounded-lg"
                        placeholder="Search by ID or Name" autocomplete="off">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M508.874 478.708L360.142 329.976c28.21-34.827 45.191-79.103 45.191-127.309C405.333 90.917 314.416 0 202.666 0S0 90.917 0 202.667s90.917 202.667 202.667 202.667c48.206 0 92.482-16.982 127.309-45.191l148.732 148.732c4.167 4.165 10.919 4.165 15.086 0l15.081-15.082c4.165-4.166 4.165-10.92-.001-15.085zM202.667 362.667c-88.229 0-160-71.771-160-160s71.771-160 160-160 160 71.771 160 160-71.771 160-160 160z">
                            </path>
                        </svg>
                    </div>
                </div>



                <script>
                    document.getElementById("searchInput").addEventListener("input", function() {
                        let filter = this.value.toLowerCase().trim();
                        let rows = document.querySelectorAll("tbody tr");

                        rows.forEach(row => {
                            let studentID = row.cells[0].textContent.toLowerCase();
                            let fullName = row.cells[1].textContent.toLowerCase();

                            row.style.display = (studentID.includes(filter) || fullName.includes(filter)) ? "" : "none";
                        });
                    });
                </script>


                <a href="/admin/add_student">
                    <button class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">
                        Add Student
                    </button>
                </a>
            </div>

            <!-- Student List Table -->
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal" style="table-layout: auto; width: 100%;">
                        <thead>
                            <tr class="bg-gray-200 text-sm font-semibold text-gray-700">

                                <th style="background-color: #222d33;" class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-white uppercase tracking-wider">Student ID</th>
                                <th style="background-color: #222d33;" class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-white uppercase tracking-wider">Full Name</th>
                                <th style="background-color: #222d33;" class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-white uppercase tracking-wider">Gender</th>
                                <th style="background-color: #222d33;" class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-white uppercase tracking-wider">Contact</th>
                                <th style="background-color: #222d33;" class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-white uppercase tracking-wider">Address</th>
                                <th style="background-color: #222d33;" class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-white uppercase tracking-wider"></th>


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

                                <td class="flex justify-center px-5 py-5 border-b border-gray-200 bg-white text-sm">


                                    <!-- Edit Button -->
                                    <a href="{{ url('admin/'.$student->id.'/edit')}}" class="relative text-blue-600 hover:text-blue-900 mr-2">
                                        <button class="relative group bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-xs flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4h2m1.293 1.293a1 1 0 00-1.414 0L4 14.172V17h2.828l7.879-7.879a1 1 0 000-1.414L12.293 5.293z" />
                                            </svg>
                                            <!-- Tooltip Below -->
                                            <span class="absolute top-full mt-1 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition-opacity z-50 pointer-events-none">
                                                Edit
                                            </span>
                                        </button>
                                    </a>

                                    <!-- Delete Button -->
                                    <a href="{{ url('/admin/'.$student->id). '/delete' }}" class="relative text-red-500 hover:underline mr-2" onclick="return confirm('Are you sure?')">
                                        <button class="relative group bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-xs flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-1 12a2 2 0 01-2 2H8a2 2 0 01-2-2L5 7m5 4v6m4-6v6M3 7h18" />
                                            </svg>
                                            <!-- Tooltip Below -->
                                            <span class="absolute top-full mt-1 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition-opacity z-50 pointer-events-none">
                                                Delete
                                            </span>
                                        </button>
                                    </a>

                                    <!-- View Records Button -->
                                    <a href="{{ url('/admin/student-records/' . $student->student_id) }}" class="relative text-green-600 hover:text-green-900">
                                        <button class="relative group bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-xs flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5c-4.2 0-7.8 2.9-9.4 7 1.6 4.1 5.2 7 9.4 7s7.8-2.9 9.4-7c-1.6-4.1-5.2-7-9.4-7zm0 2a5 5 0 110 10 5 5 0 010-10z" />
                                            </svg>
                                            <!-- Tooltip Below -->
                                            <span class="absolute top-full mt-1 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition-opacity z-50 pointer-events-none">
                                                View Attendance Records
                                            </span>
                                        </button>
                                    </a>

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
</x-navigation>