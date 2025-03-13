<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite('resources/css/app.css')

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

<body class="bg-gray-100 overflow-x-hidden">

    <nav id="navbar" class="bg-white shadow-md ml-0.5 fixed top-0 left-64 w-[calc(100%-16rem)] flex items-center justify-between px-6 py-3 z-40 transition-all duration-300">
        <button id="toggleButton" onclick="toggleSidebar()"
            class="fixed left-2 top-4 bg-white p-2 rounded text-gray-600 hover:text-gray-900 transition-all duration-300 z-50 hover:bg-gray-100">
            <svg class="w-6 h-6 min-w-[1.5rem] min-h-[1.5rem]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>

        <a href="{{ route('login') }}" class="bg-green-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-gray-700 ml-auto">
            Login
        </a>
    </nav>


    <div id="sidebar" class="min-h-screen bg-white  fixed left-0 top-0 w-65 transition-all duration-300 ease-in-out z-50">
        
        <svg class="w-8 h-8 text-indigo-500" viewBox="0 0 100 100" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M50 20C38 20 31 27 28 41C33 34 39 31 46 31C52 31 56 34 60 40C64 46 68 49 74 49C82 49 87 44 90 34C84 41 78 44 72 44C66 44 62 41 58 35C54 29 50 26 44 26C36 26 31 31 28 41M28 60C22 60 17 65 14 75C20 68 26 65 32 65C38 65 42 68 46 74C50 80 54 83 60 83C68 83 73 78 76 68C70 75 64 78 58 78C52 78 48 75 44 69C40 63 36 60 30 60H28Z" />
        </svg>
        
        <nav class="space-y-2 mt-10 ">

          
                <!-- Dashboard -->
                <a href="/" class="{{ request()->is('/') ? 'bg-gray-100 text-indigo-600 p-4 rounded-l-3xl' : 'p-4 rounded-md' }} flex items-center">
                    <svg class="w-7 h-7 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M4 10v10h5v-6h6v6h5V10"></path>
                    </svg>
                    <span class="font-medium ml-3 sidebar-label">Dashboard</span>
                </a>
            
                <!-- Attendance -->
                <a href="{{ route('Attendance') }}" class="{{ request()->is('Attendance') ? 'bg-gray-100 text-indigo-600 p-4 rounded-l-3xl' : 'p-4 rounded-md' }} flex items-center">
                    <svg class="w-7 h-7 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M9 8h6m-8 8h10M4 4h16v16H4zM7 16l2 2 4-4"></path>
                    </svg>
                    <span class="font-medium ml-3 sidebar-label">Attendance</span>
                </a>
                
                
            
                <!-- Students List -->
                <a href="{{ route('StudentsList') }}" class="{{ request()->is('StudentsList') ? 'bg-gray-100 text-indigo-600 p-4 rounded-l-3xl' : 'p-4 rounded-md' }} flex items-center">
                    <svg class="w-7 h-7 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V8H2v12h5m10-12V4a2 2 0 00-2-2H9a2 2 0 00-2 2v4m5 4a4 4 0 110-8 4 4 0 010 8zm6 8a6 6 0 00-12 0"></path>
                    </svg>
                    <span class="font-medium ml-3 sidebar-label">Students List</span>
                </a>
                
            
                <!-- Set Time -->
                <a href="{{ route('Set_time') }}" class="{{ request()->is('Set_time') ? 'bg-gray-100 text-indigo-600 p-4 rounded-l-3xl' : 'p-4' }} flex items-center">
                    <svg class="w-7 h-7 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
