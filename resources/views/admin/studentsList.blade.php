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
    <!-- Bootstrap CSS -->
</head>

<style>
    .table-wrapper {
        width: 95%;
        margin: 0 auto;
        margin-top: 3rem;
        padding: 1.5rem;
        box-sizing: border-box;
    }

    .table-container {
      
        overflow-y: auto; /* Vertical scrolling if needed */
        max-height: 70vh; /* Maximum height for the table container */
    }

    thead {
 
    position: sticky;
    top: 0; /* Position the header at the top of the container */
    z-index: 1000; /* Ensure it stays above other elements */
    background-color: #343a40; /* Match the background color for visual consistency */
    
}




</style>

<body>
    <div class="table-wrapper bg-white rounded shadow-sm mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h5 mb-0">Student List</h2>
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

                <button onclick="openAddStudentModal()" class="btn btn-primary d-flex align-items-center justify-content-center w-50 gap-1">
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
            <table class="table table-striped ">
                <thead class="table-dark rounded">
                       
                    <tr>
                        <th>Student ID</th>
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->student_id }}</td>
                        <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                        <td>{{ $student->gender }}</td>
                        <td>{{ $student->contact }}</td>
                        <td>{{ $student->address }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Options
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="openModal('{{ $student->id }}')">Edit</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/admin/' . $student->id) . '/delete' }}" onclick="return confirm('Are you sure?')">Delete</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/admin/student-records/' . $student->student_id) }}">View Attendance</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

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
