<x-navigation>

    @include('components.student-add-modal')
    @include('components.student-edit-modal')


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Student List</title>


    </head>

    <body class="bg-gray-100 p-6">


        <div class="bg-white p-6 rounded-lg shadow-md w-full">
            <div class="flex justify-between items-center pb-4">
                <h2 class="text-lg font-semibold">Student List</h2>


            </div>

            <!-- Search Input -->
            <div class="w-full flex justify-end mb-4 gap-4">

                <!-- Gender Dropdown Filter -->
                <div class="relative">
                    <select id="genderFilter"
                        class="appearance-none border border-gray-300 bg-gray-100 text-sm text-gray-600 py-2 px-4 pr-10 rounded-lg w-full">
                        <option value="">All Genders</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>

                    <!-- Custom Dropdown Icon -->
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                        <svg id="dropdownIcon" class="w-5 h-5 text-gray-600 transition-transform duration-300"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 16L6 9h12l-6 7z" />
                        </svg>
                    </div>
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





                <button onclick="openAddStudentModal()"
                    class="flex items-center bg-blue-500 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users-plus">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4c.96 0 1.84 .338 2.53 .901" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        <path d="M16 19h6" />
                        <path d="M19 16v6" />
                    </svg>

                    Add Student
                </button>

            </div>

            <!-- Student List Table -->
            <div class="relative px-4 sm:px-8 py-4"> <!-- Ensures dropdown positioning works -->

                <div class="inline-block min-w-full shadow rounded-lg max-h-[68vh] overflow-y-auto">
                    <table class="min-w-full leading-normal table-auto w-full">

                        <thead>
                            <tr class="bg-gray-200 text-sm font-semibold text-gray-700 ">

                                <th style="background-color: #222d33;"
                                    class="px-5 py-3 border-b-2 rounded-tl-lg border-gray-200 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Student ID</th>
                                <th style="background-color: #222d33;"
                                    class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Full Name</th>
                                <th style="background-color: #222d33;"
                                    class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Gender</th>
                                <th style="background-color: #222d33;"
                                    class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Contact</th>
                                <th style="background-color: #222d33;"
                                    class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Address</th>
                                <th style="background-color: #222d33;"
                                    class="px-5 py-3 border-b-2 rounded-tr-lg border-gray-200 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                </th>




                            </tr>
                        </thead>
                        <tbody class="bg-gray-100 border-b">
                            @foreach ($students as $student)
                                <tr class="border-t hover:bg-gray-100">

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        {{ $student->student_id }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        {{ $student->first_name }} {{ $student->last_name }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        {{ $student->gender }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        {{ $student->contact }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        {{ $student->address }}
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm ">

                                        <!-- Options Dropdown Button -->
                                        <div class="w-[100px]">


                                            <div class="text-left w-[20%]">
                                                <!-- Dropdown Button -->
                                                <button id="optionsButton-{{ $student->id }}"
                                                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-3 py-2 rounded text-xs flex items-center"
                                                    onclick="toggleDropdown('{{ $student->id }}')">
                                                    <span>Options</span>
                                                    <svg id="dropdownIcon"
                                                        class="w-5 h-5 text-white transition-transform duration-300"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path d="M12 16L6 9h12l-6 7z" />
                                                    </svg>

                                                </button>

                                                <!-- Dropdown Menu - Positioned Absolutely but Contained Within td -->
                                                <div id="dropdown-{{ $student->id }}"
                                                    class=" hidden mt-2 w-48 bg-white rounded-md shadow-lg border border-gray-200 z-20 ">

                                                    <div class="py-2">
                                                        <!-- Edit Option -->
                                                        <!-- Edit Button -->
                                                        <a href="javascript:void(0);"
                                                            onclick="openModal('{{ $student->id }}')"
                                                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md mx-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="w-4 h-4 mr-2 text-blue-500" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M11 4h2m1.293 1.293a1 1 0 00-1.414 0L4 14.172V17h2.828l7.879-7.879a1 1 0 000-1.414L12.293 5.293z" />
                                                            </svg>
                                                            <span>Edit</span>
                                                        </a>


                                                        <!-- Delete Option -->
                                                        <a href="{{ url('/admin/' . $student->id) . '/delete' }}"
                                                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md mx-2"
                                                            onclick="return confirm('Are you sure?')">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="w-4 h-4 mr-2 text-red-500" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-1 12a2 2 0 01-2 2H8a2 2 0 01-2-2L5 7m5 4v6m4-6v6M3 7h18" />
                                                            </svg>
                                                            <span>Delete</span>
                                                        </a>

                                                        <!-- View Records Option -->
                                                        <a href="{{ url('/admin/student-records/' . $student->student_id) }}"
                                                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md mx-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="w-5 h-5 mr-2 text-green-700" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                    fill="none" />
                                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                <path
                                                                    d="M12 18c-.328 0 -.652 -.017 -.97 -.05c-3.172 -.332 -5.85 -2.315 -8.03 -5.95c2.4 -4 5.4 -6 9 -6c3.465 0 6.374 1.853 8.727 5.558" />
                                                                <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                                <path d="M20.2 20.2l1.8 1.8" />
                                                            </svg>
                                                            <span>View Attendance</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>


                                    <!-- JavaScript for Dropdown Functionality -->
                                    <script>
                                        function toggleDropdown(studentId) {
                                            const dropdown = document.getElementById(`dropdown-${studentId}`);
                                            const isOpen = dropdown.classList.contains('block');

                                            // Close all other open dropdowns first
                                            document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                                                el.classList.add('hidden');
                                                el.classList.remove('block');
                                            });

                                            // Toggle the current dropdown
                                            if (isOpen) {
                                                dropdown.classList.add('hidden');
                                                dropdown.classList.remove('block');
                                            } else {
                                                dropdown.classList.add('block');
                                                dropdown.classList.remove('hidden');
                                            }

                                            // Close dropdown when clicking outside
                                            document.addEventListener('click', function closeDropdown(e) {
                                                const button = document.getElementById(`optionsButton-${studentId}`);
                                                if (!dropdown.contains(e.target) && e.target !== button) {
                                                    dropdown.classList.add('hidden');
                                                    dropdown.classList.remove('block');
                                                    document.removeEventListener('click', closeDropdown);
                                                }
                                            });

                                            // Prevent event from bubbling to document
                                            event.stopPropagation();
                                        }
                                    </script>

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
