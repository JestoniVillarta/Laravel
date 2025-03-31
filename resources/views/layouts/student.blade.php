<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Management')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="container mx-auto mt-6">
        @yield('content')
    </div>

    @yield('modals') <!-- This section will inject modals -->

    <script>
        function openAddStudentModal() {
            document.getElementById('addStudentModal').classList.remove('hidden');
        }

        function closeAddStudentModal() {
            document.getElementById('addStudentModal').classList.add('hidden');
        }
    </script>
</body>
</html>
