<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite('resources/css/app.css')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check localStorage for sidebar state when page loads
            const sidebarOpen = localStorage.getItem('sidebarOpen') === 'true';
            const sidebar = document.getElementById("sidebar");
            const content = document.getElementById("content");
            const toggleButton = document.getElementById("toggleButton");
            
            // Apply the saved state on page load
            if (sidebarOpen) {
                sidebar.classList.remove("-translate-x-full");
                content.classList.add("ml-64");
                toggleButton.classList.add("left-64");
            } else {
                sidebar.classList.add("-translate-x-full");
                content.classList.remove("ml-64");
                toggleButton.classList.remove("left-64");
            }
        });

// Function to get URL parameters
function getUrlParam(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

// Function to set URL parameters without page reload
function setUrlParamWithoutReload(name, value) {
    const url = new URL(window.location);
    url.searchParams.set(name, value);
    window.history.replaceState({}, '', url);
}

function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const content = document.getElementById("content");
    const toggleButton = document.getElementById("toggleButton");
    
    sidebar.classList.toggle("-translate-x-full");
    
    // Adjust content margin when sidebar is open
    const isOpen = !sidebar.classList.contains("-translate-x-full");
    
    if (isOpen) {
        content.classList.add("ml-64");
        toggleButton.classList.add("left-64");
    } else {
        content.classList.remove("ml-64");
        toggleButton.classList.remove("left-64");
    }
    
    // Instead of localStorage, use sessionStorage which is faster
    sessionStorage.setItem('sidebarOpen', isOpen);
    
    // Also add a URL parameter for direct links
    setUrlParamWithoutReload('sidebar', isOpen ? '1' : '0');
}

// When page loads, check for sidebar state
document.addEventListener('DOMContentLoaded', function() {
    // Try URL parameter first (for direct links)
    let sidebarParam = getUrlParam('sidebar');
    
    // If not in URL, check sessionStorage
    if (sidebarParam === null) {
        sidebarParam = sessionStorage.getItem('sidebarOpen');
    }
    
    const sidebarOpen = sidebarParam === '1' || sidebarParam === 'true';
    const sidebar = document.getElementById("sidebar");
    const content = document.getElementById("content");
    const toggleButton = document.getElementById("toggleButton");
    
    // Apply the saved state
    if (sidebarOpen) {
        sidebar.classList.remove("-translate-x-full");
        content.classList.add("ml-64");
        toggleButton.classList.add("left-64");
    } else {
        sidebar.classList.add("-translate-x-full");
        content.classList.remove("ml-64");
        toggleButton.classList.remove("left-64");
    }
});
    </script>
</head>

<body class="bg-gray-100 overflow-x-hidden">

    <!-- Top Navigation Bar -->
    <nav class="bg-white shadow-md fixed top-0 left-0 w-full flex items-center justify-between px-6 py-3 z-40">

        <div class="flex items-center gap-1">
            <!-- Sidebar Toggle Button -->
            <button id="toggleButton" onclick="toggleSidebar()"
                class="fixed left-2 top-4 bg-white p-2 rounded text-gray-600 hover:text-gray-900 transition-all duration-300 z-50">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>

        <a href="{{ route('login') }}" class="bg-green-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-gray-700">Login</a>
    </nav>

    <!-- Sidebar -->
    <div id="sidebar" class="w-64 min-h-screen bg-white shadow-md p-5 fixed left-0 top-0 transition-transform transform -translate-x-full duration-300 ease-in-out z-50">

        <button onclick="toggleSidebar()" class="absolute top-3 right-3 p-1 text-gray-500 hover:text-gray-700">
            <svg class="w-8 h-8" viewBox="0 0 100 100" fill="currentColor" xmlns="http://www.w3.org/2000/svg"></svg>
        </button>

        <svg class="w-8 h-8 text-indigo-500" viewBox="0 0 100 100" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M50 20C38 20 31 27 28 41C33 34 39 31 46 31C52 31 56 34 60 40C64 46 68 49 74 49C82 49 87 44 90 34C84 41 78 44 72 44C66 44 62 41 58 35C54 29 50 26 44 26C36 26 31 31 28 41M28 60C22 60 17 65 14 75C20 68 26 65 32 65C38 65 42 68 46 74C50 80 54 83 60 83C68 83 73 78 76 68C70 75 64 78 58 78C52 78 48 75 44 69C40 63 36 60 30 60H28Z" />
        </svg>

        <nav class="space-y-2 mt-10">

            <a href="/" class="flex items-center space-x-3 text-indigo-600 bg-indigo-50 p-2 rounded-md">
                <svg class="w-5 h-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M4 10v10h5v-6h6v6h5V10"></path>
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>

            <div class="text-gray-500 font-semibold mt-4 text-[13px] tracking-wide mb-1">Student Records</div>

            <a href="{{ route('Attendance') }}" class="flex items-center space-x-3 text-gray-600 p-2 hover:bg-gray-100 rounded-md">
                <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11h4m-2 0V9m0 2v2m2-4h4m0 0V9m0 2v2M8 15h4m-2 0v-2m0 2v2m2-4h4m0 0v-2m0 2v2"></path>
                </svg>
                <span class="font-medium">Attendance</span>
            </a>

            <a href="{{ route('Students') }}" class="flex items-center space-x-3 text-gray-600 p-2 hover:bg-gray-100 rounded-md">
                <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span class="font-medium">Students</span>
            </a>

            <div class="text-gray-500 font-semibold mt-4 text-[13px] tracking-wide mb-1">Time settings</div>

            <a href="{{ route('Set_time') }}" class="flex items-center space-x-3 text-gray-600 p-2 hover:bg-gray-100 rounded-md">
                <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span class="font-medium">Set_time</span>
            </a>
        </nav>

        <div class="absolute bottom-5 left-5 flex items-center space-x-3">
            <img src="https://placehold.co/40" alt="Profile" class="w-10 h-10 rounded-full">
            <span class="font-medium">Tom Cook</span>
        </div>
    </div>

    <!-- Main Content -->
    <div id="content" class="mt-16 p-6 transition-all duration-300 ease-in-out ml-0">
        <?php echo $slot ?>
    </div>

</body>

</html>