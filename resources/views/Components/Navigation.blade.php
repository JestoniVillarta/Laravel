<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let sidebarParam = getUrlParam('sidebar');

            if (sidebarParam === null) {
                sidebarParam = sessionStorage.getItem('sidebarOpen');
            }

            const sidebarOpen = sidebarParam === null || sidebarParam === '1' || sidebarParam === 'true';
            const sidebar = document.getElementById("sidebar");
            const content = document.getElementById("content");
            const toggleButton = document.getElementById("toggleButton");
            const navbar = document.getElementById("navbar"); // Add navbar reference
            const sidebarLabels = document.querySelectorAll(".sidebar-label");
            const sidebarCategories = document.querySelectorAll(".sidebar-category");
            const sidebarIcons = document.querySelectorAll("#sidebar svg");

            // Initialize sidebar state
            if (sidebarOpen) {
                sidebar.classList.remove("w-16");
                sidebar.classList.add("w-64");
                content.classList.remove("ml-16");
                content.classList.add("ml-64");
                toggleButton.style.left = "260px";

                // Handle navbar if it exists
                if (navbar) {
                    navbar.style.left = "16rem";
                    navbar.style.width = "calc(100% - 16rem)";
                }

                sidebarLabels.forEach(label => label.classList.remove("hidden"));
                sidebarCategories.forEach(category => category.classList.remove("hidden"));
            } else {
                sidebar.classList.remove("w-64");
                sidebar.classList.add("w-16");
                content.classList.remove("ml-64");
                content.classList.add("ml-16");
                toggleButton.style.left = "72px";

                // Handle navbar if it exists
                if (navbar) {
                    navbar.style.left = "4rem";
                    navbar.style.width = "calc(100% - 4rem)";
                }

                sidebarLabels.forEach(label => label.classList.add("hidden"));
                sidebarCategories.forEach(category => category.classList.add("hidden"));
            }

            // Ensure icons maintain consistent size
            sidebarIcons.forEach(icon => {
                icon.classList.add("min-w-[1.75rem]", "min-h-[1.75rem]");
            });
        });

        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const content = document.getElementById("content");
            const toggleButton = document.getElementById("toggleButton");
            const navbar = document.getElementById("navbar"); // Add navbar reference
            const sidebarLabels = document.querySelectorAll(".sidebar-label");
            const sidebarCategories = document.querySelectorAll(".sidebar-category");
            const sidebarIcons = document.querySelectorAll("#sidebar svg");

            const isExpanded = sidebar.classList.contains("w-64");

            if (isExpanded) {
                sidebar.classList.remove("w-64");
                sidebar.classList.add("w-16");
                content.classList.remove("ml-64");
                content.classList.add("ml-16");
                toggleButton.style.left = "72px";

                // Handle navbar if it exists
                if (navbar) {
                    navbar.style.left = "4rem";
                    navbar.style.width = "calc(100% - 4rem)";
                }

                sidebarLabels.forEach(label => label.classList.add("hidden"));
                sidebarCategories.forEach(category => category.classList.add("hidden"));
            } else {
                sidebar.classList.remove("w-16");
                sidebar.classList.add("w-64");
                content.classList.remove("ml-16");
                content.classList.add("ml-64");
                toggleButton.style.left = "260px";

                // Handle navbar if it exists
                if (navbar) {
                    navbar.style.left = "16rem";
                    navbar.style.width = "calc(100% - 16rem)";
                }

                sidebarLabels.forEach(label => label.classList.remove("hidden"));
                sidebarCategories.forEach(category => category.classList.remove("hidden"));
            }

            // Ensure icons maintain consistent size during toggle
            sidebarIcons.forEach(icon => {
                icon.classList.add("min-w-[1.75rem]", "min-h-[1.75rem]");
            });

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

<body class="bg-gray-300 overflow-x-hidden">

    <nav id="navbar" class="bg-white shadow-md ml-0.5 fixed top-0 left-64 w-[calc(100%-16rem)] flex items-center justify-between px-6 py-2 z-40 transition-all duration-300">
        <button id="toggleButton" onclick="toggleSidebar()"
            class="fixed left-2 top-4 bg-white p-2 rounded text-gray-600 hover:text-gray-900 transition-all duration-300 z-50 hover:bg-gray-100">
            <svg class="w-7 h-7 min-w-[1.5rem] min-h-[1.5rem]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>

        <div class="relative ml-auto">
            <button id="adminDropdownButton" class="flex items-center space-x-2  p-1 rounded-lg hover:bg-gray-100 transition-all">

           <img src="{{ asset('img/admin.jpg') }}" alt="Admin Image" class="w-[50px] h-[50px] rounded-full object-cover aspect-square">

                <span class="text-gray-700">Admin</span>
                <svg id="dropdownIcon" class="w-5 h-5 text-gray-600 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 16L6 9h12l-6 7z" />
                </svg>

            </button>

            <div id="adminDropdownMenu" class="hidden absolute right-0 rounded-lg py-1">
                <form method="POST" action="{{ route('admin.logout') }}" class="bg-gray-100 rounded-lg p-1 ">
                    @csrf

                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-200 rounded flex items-center">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"
                        viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-logout-2 mr-2">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                        <path d="M15 12h-12l3 -3" /><path d="M6 15l-3 -3" />
                       </svg>

                        Log Out

                    </button>
                </form>
            </div>
        </div>
    </nav>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dropdownButton = document.getElementById("adminDropdownButton");
        const dropdownMenu = document.getElementById("adminDropdownMenu");

        dropdownButton.addEventListener("click", function (event) {
            dropdownMenu.classList.toggle("hidden");
            event.stopPropagation(); // Prevent click from reaching document
        });

        document.addEventListener("click", function (event) {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add("hidden");
            }
        });
    });
</script>



    <div id="sidebar" class="min-h-screen bg-white  fixed left-0 top-0 w-65 transition-all duration-300 ease-in-out z-50">

    <img src="{{ asset('img/logo.png') }}" alt="" class="w-[80px] h[80px] rounded-full object-cover flex justify-center items-center mx-auto mt-4">


        <nav class="space-y-2 mt-10 ">


            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'bg-gray-300 text-blue-700 p-4 rounded-l-3xl' : 'p-4 rounded-md' }} flex items-center">
                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M4 10v10h5v-6h6v6h5V10"></path>
                </svg>
                <span class="font-medium ml-3 sidebar-label">Dashboard</span>
            </a>

            <!-- Attendance -->
            <a href="{{ route('admin.attendance') }}" class="{{ request()->is('admin/attendance') ? 'bg-gray-300 text-blue-700 p-4 rounded-l-3xl' : 'p-4 rounded-md' }} flex items-center">
                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M9 8h6m-8 8h10M4 4h16v16H4zM7 16l2 2 4-4"></path>
                </svg>
                <span class="font-medium ml-3 sidebar-label">Attendance</span>
            </a>



            <!-- Students List -->
            <a href="{{ route('admin.studentsList') }}" class="{{ request()->is('admin/studentsList') ? 'bg-gray-300 text-blue-700 p-4 rounded-l-3xl' : 'p-4 rounded-md' }} flex items-center">
                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V8H2v12h5m10-12V4a2 2 0 00-2-2H9a2 2 0 00-2 2v4m5 4a4 4 0 110-8 4 4 0 010 8zm6 8a6 6 0 00-12 0"></path>
                </svg>
                <span class="font-medium ml-3 sidebar-label">Students List</span>
            </a>


            <!-- Set Time -->
            <a href="{{ route('admin.set_time') }}" class="{{ request()->is('admin/set_time') ? 'bg-gray-300 text-blue-700 p-4 rounded-l-3xl' : 'p-4' }} flex items-center">
                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m5-3a9 9 0 11-6.32-8.94"></path>
                </svg>
                <span class="font-medium ml-3 sidebar-label">Set Time</span>
            </a>






    </div>

    <div id="content" class="mt-16 p-6 ml-64 transition-all duration-300 ease-in-out">
        {{ $slot }}
    </div>
</body>

</html>
