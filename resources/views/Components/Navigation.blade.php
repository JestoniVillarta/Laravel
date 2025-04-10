<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        *{
          font-family: "Gill Sans", sans-serif;
          font-size: 15px;
        }

        h2 {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 32px;
            font-weight: bold;
        }


        #sidebar {
            height: 100vh;
            transition: all 0.3s;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #content {
            transition: all 0.3s;
            height:100vh;
            padding-top: 70px;
            margin-left: 250px; /* Match sidebar width */
            width: calc(100% - 250px); /* Adjust width to account for sidebar */
        }

        #toggleButton {
            transition: all 0.3s;
            position: fixed;
            z-index: 1050;
        }

        #toggleButton:hover {
            background-color: #f1f1f1;
        }

        .sidebar-icon {
            width: 1.75rem;
            height: 1.75rem;
            min-width: 1.75rem;
            min-height: 1.75rem;
        }





        .nav-link:hover {
            color: rgb(163, 165, 167);
        }

        #navbar {
            transition: all 0.3s;
            position: fixed;
            top: 0;
            left: 250px; /* Match sidebar width */
            width: calc(100% - 250px); /* Adjust width to account for sidebar */
            z-index: 999;
            background-color: #ffffff;
        }

        .logo-container {
            transition: all 0.3s;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 15vh;
        }

        .sidebar-logo {
            transition: all 0.3s;
            object-fit: cover;
            border-radius: 50%;
        }

    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let sidebarParam = getUrlParam('sidebar');

            if (sidebarParam === null) {
                sidebarParam = sessionStorage.getItem('sidebarOpen');
            }

            const sidebarOpen = sidebarParam === null || sidebarParam === '1' || sidebarParam === 'true';

            // Initialize sidebar state
            setSidebarState(sidebarOpen);
        });

        function setSidebarState(isOpen) {
            const sidebar = document.getElementById("sidebar");
            const content = document.getElementById("content");
            const toggleButton = document.getElementById("toggleButton");
            const navbar = document.getElementById("navbar");
            const logo = document.getElementById("sidebar-logo");
            const sidebarLabels = document.querySelectorAll(".sidebar-label");
            const sidebarCategories = document.querySelectorAll(".sidebar-category");

            if (isOpen) {
                sidebar.style.width = "250px";
                content.style.marginLeft = "250px";
                content.style.width = "calc(100% - 250px)";
                toggleButton.style.left = "260px";

                logo.style.width = "80px";
                logo.style.height = "80px";

                if (navbar) {
                    navbar.style.left = "250px";
                    navbar.style.width = "calc(100% - 250px)";
                }

                sidebarLabels.forEach(label => label.classList.remove("d-none"));
                sidebarCategories.forEach(category => category.classList.remove("d-none"));
            } else {
                sidebar.style.width = "70px";
                content.style.marginLeft = "70px";
                content.style.width = "calc(100% - 70px)";
                toggleButton.style.left = "75px";

                logo.style.width = "40px";
                logo.style.height = "40px";



                if (navbar) {
                    navbar.style.left = "70px";
                    navbar.style.width = "calc(100% - 70px)";
                }

                sidebarLabels.forEach(label => label.classList.add("d-none"));
                sidebarCategories.forEach(category => category.classList.add("d-none"));
            }
        }

        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const isExpanded = sidebar.style.width === "250px";

            setSidebarState(!isExpanded);

            sessionStorage.setItem('sidebarOpen', !isExpanded);
            setUrlParamWithoutReload('sidebar', !isExpanded ? '1' : '0');
        }

        function getUrlParam(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }

        function setUrlParamWithoutReload(name, value) {
            const url = new URL(window.location);
            url.searchParams.set(name, value);
            window.history.replaceState({}, '', url);
        }
    </script>
</head>

<body class="bg-light">
    <div id="sidebar" style="width: 250px;" class="px-1 ">
        <div class="d-flex justify-content-center align-items-center " style="height: 15vh">
            <img id="sidebar-logo" src="{{ asset('img/logo.png') }}" alt="Logo" class="sidebar-logo "
                style="width: 80px; height: 80px;">
        </div>

        <div class="nav flex-column gap-3">
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
   class="nav-link {{ request()->is('admin/dashboard') ? 'bg-dark-subtle text-black fw-bold rounded-3' : 'fw-bold text-black' }} d-flex align-items-center">
   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
       class="sidebar-icon" viewBox="0 0 16 16">
       <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708z" />
       <path d="M11.07 9.047a1.5 1.5 0 0 0-1.742.26l-.02.021a1.5 1.5 0 0 0-.261 1.742 1.5 1.5 0 0 0 0 2.86 1.5 1.5 0 0 0-.12 1.07H3.5A1.5 1.5 0 0 1 2 13.5V9.293l6-6 4.724 4.724a1.5 1.5 0 0 0-1.654 1.03" />
       <path d="m13.158 9.608-.043-.148c-.181-.613-1.049-.613-1.23 0l-.043.148a.64.64 0 0 1-.921.382l-.136-.074c-.561-.306-1.175.308-.87.869l.075.136a.64.64 0 0 1-.382.92l-.148.045c-.613.18-.613 1.048 0 1.229l.148.043a.64.64 0 0 1 .382.921l-.074.136c-.306.561.308 1.175.869.87l.136-.075a.64.64 0 0 1 .92.382l.045.149c.18.612 1.048.612 1.229 0l.043-.15a.64.64 0 0 1 .921-.38l.136.074c.561.305 1.175-.309.87-.87l-.075-.136a.64.64 0 0 1 .382-.92l.149-.044c.612-.181.612-1.049 0-1.23l-.15-.043a.64.64 0 0 1-.38-.921l.074-.136c.305-.561-.309-1.175-.87-.87l-.136.075a.64.64 0 0 1-.92-.382ZM12.5 14a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3" />
   </svg>
   <span class="sidebar-label ms-3 d-flex align-items-center">Dashboard</span>
</a>

            <!-- Attendance -->
            <a href="{{ route('admin.attendance') }}"
                class="nav-link {{ request()->is('admin/attendance') ? 'bg-dark-subtle text-black fw-bold rounded-3' : 'fw-bold text-black' }} d-flex align-items-center ">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" class="sidebar-icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6M9 8h6m-8 8h10M4 4h16v16H4zM7 16l2 2 4-4"></path>
                </svg>
                <span class="ms-3 sidebar-label d-flex align-items-center">Attendance</span>
            </a>

            <!-- Students List -->
            <a href="{{ route('admin.studentsList') }}"
                class="nav-link {{ request()->is('admin/studentsList') ?  'bg-dark-subtle text-black fw-bold rounded-3' : 'fw-bold text-black' }} d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" class="sidebar-icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5V8H2v12h5m10-12V4a2 2 0 00-2-2H9a2 2 0 00-2 2v4m5 4a4 4 0 110-8 4 4 0 010 8zm6 8a6 6 0 00-12 0">
                    </path>
                </svg>
                <span class="ms-3 sidebar-label d-flex align-items-center">Students List</span>
            </a>

            <!-- Set Time -->
            <a href="{{ route('admin.set_time') }}"
                class="nav-link {{ request()->is('admin/set_time') ? 'bg-dark-subtle text-black fw-bold rounded-3' : 'fw-bold text-black' }} d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" class="sidebar-icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m5-3a9 9 0 11-6.32-8.94"></path>
                </svg>
                <span class="ms-3 sidebar-label d-flex align-items-center">Set Time</span>
            </a>
        </div>
    </div>

    <nav id="navbar" class="shadow-sm">
        <div class="container-fluid d-flex justify-content-between align-items-center py-2 px-4">
            <button id="toggleButton" onclick="toggleSidebar()" class="btn border-0 rounded "
                style="left: 260px; top: 15px;  padding: 8px 13px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    class="sidebar-icon">
                    <path d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>

            <div class="dropdown ms-auto">
                <button id="adminDropdownButton" class="btn btn-light d-flex align-items-center gap-2 border-0 dropdown-toggle"
                    type="button" class="" data-bs-toggle="dropdown" aria-expanded="false" >
                    <img src="{{ asset('img/admin.jpg') }}" alt="Admin Image" class="rounded-circle "
                        style="width: 50px; height: 50px; object-fit: cover;">
                    <span class="text-secondary">Admin</span>
                    <i class="bi bi-chevron-down"></i>
                </button>

                <ul id="adminDropdownMenu" class="dropdown-menu dropdown-menu-end shadow ">
                    <li>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="sidebar-icon me-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                                    <path d="M15 12h-12l3 -3" />
                                    <path d="M6 15l-3 -3" />
                                </svg>
                                Log Out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="content">
        {{ $slot }}
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Initialize dropdowns
        document.addEventListener("DOMContentLoaded", function() {
            // For older Bootstrap versions that don't auto-initialize
            var dropdownElementList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'));
            var dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl);
            });
        });
    </script>
</body>

</html>
