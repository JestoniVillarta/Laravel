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
            const sidebarLabels = document.querySelectorAll(".sidebar-label");
            const sidebarCategories = document.querySelectorAll(".sidebar-category");
    
            if (sidebarOpen) {
                sidebar.classList.remove("w-16");
                sidebar.classList.add("w-64");
                content.classList.add("ml-64");
                toggleButton.classList.add("left-64");
                sidebarLabels.forEach(label => label.classList.remove("hidden"));
                sidebarCategories.forEach(category => category.classList.remove("hidden"));
            } else {
                sidebar.classList.remove("w-64");
                sidebar.classList.add("w-16");
                content.classList.remove("ml-64");
                content.classList.add("ml-16");
                toggleButton.classList.remove("left-64");
                toggleButton.classList.add("left-16");
                sidebarLabels.forEach(label => label.classList.add("hidden"));
                sidebarCategories.forEach(category => category.classList.add("hidden"));
            }
        });
    
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const content = document.getElementById("content");
            const toggleButton = document.getElementById("toggleButton");
            const sidebarLabels = document.querySelectorAll(".sidebar-label");
            const sidebarCategories = document.querySelectorAll(".sidebar-category");
    
            const isExpanded = sidebar.classList.contains("w-64");
    
            if (isExpanded) {
                sidebar.classList.remove("w-64");
                sidebar.classList.add("w-16");
                content.classList.remove("ml-64");
                content.classList.add("ml-16");
                toggleButton.style.left = "72px";
                sidebarLabels.forEach(label => label.classList.add("hidden"));
                sidebarCategories.forEach(category => category.classList.add("hidden"));
            } else {
                sidebar.classList.remove("w-16");
                sidebar.classList.add("w-64");
                content.classList.remove("ml-16");
                content.classList.add("ml-64");
                toggleButton.style.left = "260px";
                sidebarLabels.forEach(label => label.classList.remove("hidden"));
                sidebarCategories.forEach(category => category.classList.remove("hidden"));
            }
    
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
    <nav class="bg-white shadow-md fixed top-0 left-0 w-full flex items-center justify-between px-6 py-3 z-40">
        <button id="toggleButton" onclick="toggleSidebar()"
            class="fixed left-2 top-4 bg-white p-2 rounded text-gray-600 hover:text-gray-900 transition-all duration-300 z-50">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>

    
      
            <a href="{{ route('login') }}" class="bg-green-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-gray-700 ml-auto">
                Login
            </a>
    
        
        

    </nav>

    <div id="sidebar" class="min-h-screen bg-white shadow-md p-5 fixed left-0 top-0 w-64 transition-all duration-300 ease-in-out z-50">
        <svg class="w-8 h-8 text-indigo-500 mx-auto" viewBox="0 0 100 100" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M50 20C38 20 31 27 28 41C33 34 39 31 46 31C52 31 56 34 60 40C64 46 68 49 74 49C82 49 87 44 90 34C84 41 78 44 72 44C66 44 62 41 58 35C54 29 50 26 44 26C36 26 31 31 28 41M28 60C22 60 17 65 14 75C20 68 26 65 32 65C38 65 42 68 46 74C50 80 54 83 60 83C68 83 73 78 76 68C70 75 64 78 58 78C52 78 48 75 44 69C40 63 36 60 30 60H28Z" />
        </svg>

        <nav class="space-y-2 mt-10">
            <a href="/" class="flex items-center text-indigo-600 bg-indigo-50 p-2 rounded-md">
                <svg class="w-5 h-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M4 10v10h5v-6h6v6h5V10"></path>
                </svg>
                <span class="font-medium ml-3 sidebar-label">Dashboard</span>
            </a>
            <a href="{{ route('Attendance') }}" class="flex items-center text-indigo-600 bg-indigo-50 p-2 rounded-md">
                <span class="font-medium ml-3 sidebar-label">Attendance</span>
            </a>
            <a href="{{ route('StudentsList') }}" class="flex items-center text-indigo-600 bg-indigo-50 p-2 rounded-md">
                <span class="font-medium ml-3 sidebar-label">Students List</span>
            </a>
            <a href="{{ route('Set_time') }}" class="flex items-center text-indigo-600 bg-indigo-50 p-2 rounded-md">
                <span class="font-medium ml-3 sidebar-label">Set Time</span>
            </a>
        </nav>
    </div>

    <div id="content" class="mt-16 p-6 ml-64 transition-all duration-300 ease-in-out">
        {{ $slot }}
    </div>
</body>
</html>
