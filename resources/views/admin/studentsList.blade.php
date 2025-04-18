<x-navigation>
    @include('components.student-edit-modal')
    @include('components.student-add-modal')

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Student List</title>
        <!-- Bootstrap CSS -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    </head>

    <style>
        .table-wrapper {
            width: 95%;
            margin: 0 auto;
            margin-top: 3rem;
            padding: 1.5rem;
        }

        .table-container {
            overflow-y: auto;
            max-height: 75vh;
        }

        thead {
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: #343a40;
            height: 3.5rem;
        }

        td {
            height: 4.5rem;
        }

        .dropdown-item {
            font-weight: bold
        }

        /* Edit item styles */
        .edit-item {
            color: #007bff;
        }

        .edit-item svg {
            color: #007bff;
        }

        /* Delete item styles */
        .delete-item {
            color: #dc3545;
            /* Red color */
        }

        .delete-item svg {
            fill: #dc3545;
        }

        /* View item styles */
        .view-item {
            color: #28a745;
        }

        .view-item svg {
            color: #28a745;
        }

        /* Optional: Hover effects for each item */
        .edit-item:hover {
            color: #218838;
            /* Darker green */
        }

        .edit-item:hover svg {
            fill: #218838;
        }

        .delete-item:hover {
            color: #c82333;
            /* Darker red */
        }

        .delete-item:hover svg {
            fill: #c82333;
        }

        .view-item:hover {
            color: #0056b3;
            /* Darker blue */
        }

        .view-item:hover svg {
            fill: #0056b3;
        }
    </style>

    <body>
        <div class="table-wrapper bg-white rounded shadow-sm mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Student List</h2>
                <!-- Search Input and Gender Dropdown Filter -->
                <div class="d-flex justify-content-end mb-3 gap-3 w-50">

                    <select id="genderFilter" class="form-select w-50">
                        <option value="">All Genders</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>

                    <div class="input-group">
                        <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.099zm-5.21 1.39a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11z" />
                            </svg>
                        </span>
                        <input type="text" id="searchInput" class="form-control" placeholder="Search by ID or Name" autocomplete="off">
                    </div>



                    <button type="button" class="btn btn-primary d-flex align-items-center justify-content-center w-50 gap-1" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users-plus">
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
            </div>





            <!-- Student List Table -->
            <div class="table-container">
                <table class="table border-2  ">
                    <thead class="table-dark">
                        <tr >
                            <th style="border-top-left-radius: 10px">Student ID</th>
                            <th>Full Name</th>
                            <th>Gender</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th style="border-top-right-radius: 10px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                        <tr  class="align-middle">
                            <td  class="px-3">{{ $student->student_id }}</td>
                            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                            <td>{{ $student->gender }}</td>
                            <td>{{ $student->contact }}</td>
                            <td>{{ $student->address }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                        Options
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item edit-item btn" data-bs-toggle="modal" data-bs-target="#editModal-{{ $student->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                </svg>
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item delete-item" href="{{ url('/admin/' . $student->id) . '/delete' }}" onclick="return confirm('Are you sure?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                                </svg>
                                                Delete
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item view-item" href="{{ url('/admin/student-records/' . $student->student_id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                                </svg>
                                                View Attendance
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>



        <script>
            document.getElementById("genderFilter").addEventListener("change", function() {
                let genderValue = this.value.trim().toLowerCase();
                let rows = document.querySelectorAll("tbody tr");

                rows.forEach(row => {
                    let gender = row.cells[2].textContent.trim().toLowerCase();

                    row.style.display = (genderValue === "" || gender === genderValue) ? "" : "none";
                });
            });

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
    </body>

    </html>
</x-navigation>
