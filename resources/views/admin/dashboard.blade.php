<x-navigation>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Dashboard</title>
    </head>

    <style>
       
        .card-stat {
            border-left: 4px solid;
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
            color: rgba(255,255,255,.6);
            padding: .75rem 1rem;
            margin-bottom: .2rem;
        }
        .sidebar .nav-link:hover {
            color: rgba(255,255,255,.9);
        }
        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,.1);
        }
        .sidebar-heading {
            color: rgba(255,255,255,.4);
            font-size: .8rem;
            text-transform: uppercase;
            letter-spacing: .1rem;
            padding: 1rem;
        }
        .border-left-primary { border-left-color: #4e73df; }
        .border-left-success { border-left-color: #1cc88a; }
        .border-left-warning { border-left-color: #f6c23e; }
        .border-left-danger { border-left-color: #e74a3b; }
    </style>
   


    <body>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Attendance Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-download fa-sm text-white-50 me-1"></i> Generate Report
                        </a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Present Today Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-100 py-2 card-stat border-left-primary">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col me-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Present Today</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">342</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Absent Today Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-100 py-2 card-stat border-left-danger">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col me-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Absent Today</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar-times fa-2x text-gray-300"></i>
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
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Late Arrivals</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">24</div>
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
                                                Monthly Attendance Rate</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 me-3 font-weight-bold text-gray-800">95%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm me-2">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 95%"></div>
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

                    <div class="row">
                        <!-- Attendance Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Weekly Attendance Overview</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="attendanceChart" style="width: 100%; height: 300px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Class Attendance Distribution</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

                    


    </body>
    </html>

</x-navigation>
