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
            border-bottom: 20px solid;
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
            width: 100%;
        }

        .card-title {
            font-weight: bold;
            text-transform: uppercase;
        }

        .card-text {
            font-size: 1.2rem;
        }

        .btn-secondary:hover {
            background-color: #0056b3;
            color: white;
        }

        .form-select {
            display: block;
            width: auto;
            padding: 0.375rem 2.25rem 0.375rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            appearance: none;
        }

        .form-select:focus {
            border-color: #86b7fe;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .me-2 {
            margin-right: 0.5rem;
        }

        .attendance-rate-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .chart-container {
        position: relative;
        width: 250px;  /* Increase width */
        height: 250px; /* Increase height */
    }

    #circularAttendanceChart {
        width: 100% !important;
        height: 100% !important;
    }

    .attendance-rate-value {
        position: absolute;
        top: 40%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
    }

    .attendance-rate-label {
        position: absolute;
        top: 65%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1rem;
        color: #666;
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

            <!-- Content Row for the 3 Boxes (removed Monthly Attendance Rate Card) -->
            <div class="row mt-4">
                <!-- Present Today Card -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success card-stat shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Present Today
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $present }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Absent Today Card -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-danger card-stat shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Absent Today
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $absent }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Students Card -->
                <div class="col-xl-4 col-md-6 mb-4">
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
                            <form action="{{ route('admin.dashboard') }}" method="GET"
                                class="d-flex align-items-center">
                                <label for="filter" class="me-2">Select Filter:</label>
                                <select id="filter" name="filter" class="form-select form-select-sm"
                                    onchange="this.form.submit()">
                                    <option value="weekly" {{ $filter == 'weekly' ? 'selected' : '' }}>Last 7 Days
                                    </option>
                                    <option value="monthly" {{ $filter == 'monthly' ? 'selected' : '' }}>This Month
                                    </option>
                                </select>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="chart-area" >
                                <canvas id="attendanceChart" style="width: 100%; height: 300px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Circular Attendance Rate Chart (smaller size) -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Monthly Attendance Rate</h6>
                        </div>
                        <div class="card-body">
                            <div class="attendance-rate-container">
                                <div class="chart-container">
                                    <canvas id="circularAttendanceChart"></canvas>
                                    <div class="attendance-rate-value">{{ number_format($attendanceRate, 1) }}%</div>

                                </div>
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
            var attendanceRate = {{ $attendanceRate }};

            var ctx = document.getElementById('attendanceChart').getContext('2d');
            var attendanceChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Present',
                            data: presentData,
                            backgroundColor: '#1cc88a',
                            borderColor: '#1cc88a',
                            borderWidth: 1,
                            borderRadius: {
                                topLeft: 15,
                                topRight: 15,
                                bottomLeft: 0,
                                bottomRight: 0
                            },
                            barPercentage: 0.4,
                            categoryPercentage: 0.7
                        },
                        {
                            label: 'Absent',
                            data: absentData,
                            backgroundColor: '#e74a3b',
                            borderColor: '#e74a3b',
                            borderWidth: 1,
                            borderRadius: {
                                topLeft: 15,
                                topRight: 15,
                                bottomLeft: 0,
                                bottomRight: 0
                            },
                            barPercentage: 0.4,
                            categoryPercentage: 0.7
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 10,
                            bottom: 0
                        }
                    },
                    scales: {
                        x: {
                            stacked: false
                        },
                        y: {
                            beginAtZero: true,
                            stacked: false
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            align: 'center',
                            labels: {
                                boxWidth: 20,
                                padding: 15
                            }
                        }
                    }
                }
            });

            // Circular Attendance Rate Chart (smaller size)
            var circleCtx = document.getElementById('circularAttendanceChart').getContext('2d');
var circularAttendanceChart = new Chart(circleCtx, {
    type: 'doughnut',
    data: {
        labels: ['Attendance Rate'],
        datasets: [
            // Background full ring (gray)
            {
                data: [100],
                backgroundColor: ['#eaecf4'],
                borderWidth: 0,
                cutout: '80%',
            },
            // Foreground (green) partial arc
            {
                data: [attendanceRate],
                backgroundColor: ['#1cc88a'],
                borderWidth: 0,
                borderRadius: 10, // 👈 Rounded end only here
                circumference: (attendanceRate / 100) * 360,

                cutout: '80%'
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                enabled: false
            }
        }
    }
});


            // Position the percentage text in the center of the doughnut
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelector('.attendance-rate-value').style.position = 'absolute';
                document.querySelector('.attendance-rate-value').style.top = '50%';
                document.querySelector('.attendance-rate-value').style.left = '50%';
                document.querySelector('.attendance-rate-value').style.transform = 'translate(-50%, -50%)';
                document.querySelector('.attendance-rate-label').style.position = 'absolute';
                document.querySelector('.attendance-rate-label').style.top = '65%';
                document.querySelector('.attendance-rate-label').style.left = '50%';
                document.querySelector('.attendance-rate-label').style.transform = 'translate(-50%, 0)';
            });
        </script>
    </body>

    </html>
</x-Navigation>
