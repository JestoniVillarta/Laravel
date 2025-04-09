<x-Navigation>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Dashboard</title>
        <!-- Include Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>

    <style>
        * {
            font-family: "Gill Sans", sans-serif;
            font-size: 15px;

        }

        .dashboard-container {
            width: 95%;
            margin-top: 3rem;
            margin: 0 auto;
            padding: 1.5rem;
            box-sizing: border-box;
        }

        .card-stat {
            border-bottom: 6px solid;
            border-radius: 4px;
        }

        .bg-gradient-primary {
            background: linear-gradient(to right, #4e73df, #224abe);
            color: white;
        }

        .sidebar {
            min-height: 100vh;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, .6);
            padding: .75rem 1rem;
            margin-bottom: .2rem;
        }

        .sidebar .nav-link:hover {
            color: rgba(255, 255, 255, .9);
        }

        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, .1);
        }

        .sidebar-heading {
            color: rgba(255, 255, 255, .4);
            font-size: .8rem;
            text-transform: uppercase;
            letter-spacing: .1rem;
            padding: 1rem;
        }

        .border-left-primary {
            border-bottom-color: #4e73df;
        }

        .border-left-success {
            border-bottom-color: #1cc88a;
        }

        .border-left-warning {
            border-bottom-color: #36b9cc;
        }

        .border-left-danger {
            border-bottom-color: #e74a3b;
        }

        .card-body {
            padding: 1rem;
        }

        .card-title {
            font-weight: bold;
            text-transform: uppercase;
        }

        .card-text {
            font-size: 1.2rem;
        }

        .btn-secondary:hover {
    background-color: #0056b3;  /* New hover background color */
    color: white;               /* Change text color on hover */
}
    </style>

    <body>

        <div class="dashboard-container bg-white rounded shadow-sm mt-4">
            <!-- Dashboard Header -->
            <div class="d-sm-flex align-items-center justify-content-between">
                <h2>Attendance Dashboard</h2>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50 me-1"></i> Generate Report
                </a>
            </div>

            <!-- Content Row for the 4 Boxes -->
            <div class="row mt-4">
                <!-- Present Today Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success card-stat shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Present Today
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Morning: {{ $presentMorning }}
                                    </div>
                                </div>
                                <div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Afternoon: {{ $presentAfternoon }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Absent Today Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger card-stat shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Absent Today
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Morning: {{ $absentMorning }}
                                    </div>
                                </div>
                                <div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Afternoon: {{ $absentAfternoon }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Late Arrivals Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card shadow h-100 py-2 card-stat border-left-warning">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Total Students
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $totalStudents }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clock fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Monthly Attendance Rate Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card shadow h-100 py-2 card-stat border-left-success">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Monthly Attendance Rate
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 me-3 font-weight-bold text-gray-800">
                                                {{ number_format($attendanceRate, 2) }}%

                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm me-2">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: {{ $attendanceRate }}%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="row">
                <!-- Attendance Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                            <h6 class="m-0 font-weight-bold text-primary">
                                Attendance Overview (Morning and Afternoon)
                            </h6>

                            <form action="{{ route('admin.dashboard') }}" method="GET" class="mb-3 w-50">
                                <div class="form-group d-flex align-items-center justify-content-end gap-1">
                                    <label for="filter">Select Filter:</label>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">

                                            {{ $filter == 'weekly' ? 'Last 7 Days' : 'This Month' }}
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('admin.dashboard', ['filter' => 'weekly']) }}">Last 7
                                                    Days</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('admin.dashboard', ['filter' => 'monthly']) }}">This
                                                    Month</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </form>


                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="attendanceChart" style="width: 100%; height: 300px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>






                <!-- Class Attendance Distribution Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Class Attendance Distribution</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-pie">
                                <canvas id="classPieChart" style="width: 100%; height: 250px;"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="me-2">
                                    <i class="fas fa-circle text-primary"></i> Class A
                                </span>
                                <span class="me-2">
                                    <i class="fas fa-circle text-success"></i> Class B
                                </span>
                                <span class="me-2">
                                    <i class="fas fa-circle text-info"></i> Class C
                                </span>
                                <span class="me-2">
                                    <i class="fas fa-circle text-warning"></i> Class D
                                </span>
                            </div>
                        </div>


                    </div>


                </div>


            </div>


        </div>



        <!-- Initialize Chart.js -->
        <script>
            var labels = {!! json_encode($dates) !!};
            var presentData = {!! json_encode($presentData) !!};
            var absentData = {!! json_encode($absentData) !!};

            // Create morning and afternoon data arrays
            var morningPresentData = [];
            var morningAbsentData = [];
            var afternoonPresentData = [];
            var afternoonAbsentData = [];

            // Populate morning and afternoon data
            presentData.forEach(function(value) {
                morningPresentData.push(value * 0.55); // Example morning present
                afternoonPresentData.push(value * 0.45); // Example afternoon present
            });

            absentData.forEach(function(value) {
                morningAbsentData.push(value * 0.45); // Example morning absent
                afternoonAbsentData.push(value * 0.55); // Example afternoon absent
            });

            var ctx = document.getElementById('attendanceChart').getContext('2d');
            var attendanceChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels, // Dates as labels
                    datasets: [
                        // Morning Present Dataset
                        {
                            label: 'Morning Present',
                            data: morningPresentData,
                            backgroundColor: '#4e73df', // Blue for morning present
                            borderColor: '#4e73df',
                            borderWidth: 1,
                            barPercentage: 0.35, // Make bars narrower to create space for the afternoon bars
                            categoryPercentage: 0.8,
                            stack: 'morning'
                        },
                        {
                            label: 'Morning Absent',
                            data: morningAbsentData,
                            backgroundColor: '#e74a3b', // Red for morning absent
                            borderColor: '#e74a3b',
                            borderWidth: 1,
                            barPercentage: 0.35,
                            categoryPercentage: 0.8,
                            stack: 'morning'
                        },
                        // Afternoon Present Dataset
                        {
                            label: 'Afternoon Present',
                            data: afternoonPresentData,
                            backgroundColor: '#1cc88a', // Green for afternoon present
                            borderColor: '#1cc88a',
                            borderWidth: 1,
                            barPercentage: 0.35, // Adjust the width for the afternoon bars
                            categoryPercentage: 0.8,
                            stack: 'afternoon'
                        },
                        {
                            label: 'Afternoon Absent',
                            data: afternoonAbsentData,
                            backgroundColor: '#f6c23e', // Yellow for afternoon absent
                            borderColor: '#f6c23e',
                            borderWidth: 1,
                            barPercentage: 0.35,
                            categoryPercentage: 0.8,
                            stack: 'afternoon'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            stacked: true, // Stack bars for morning and afternoon separately
                            barPercentage: 0.8,
                        },
                        y: {
                            beginAtZero: true,
                            stacked: true // Stack the bars vertically
                        }
                    }
                }
            });


            // Class Attendance Distribution Pie Chart Data
            var classPieChart = document.getElementById('classPieChart').getContext('2d');
            var myClassPieChart = new Chart(classPieChart, {
                type: 'pie',
                data: {
                    labels: ['Class A', 'Class B', 'Class C', 'Class D'],
                    datasets: [{
                        data: [30, 40, 20, 10],
                        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
                    }]
                }
            });
        </script>
    </body>

    </html>
</x-Navigation>
