<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance</title>
    <!-- Bootstrap 5 CSS CDN -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">

    <h1 class="text-center mb-4 fw-bold">TRAINEE ATTENDANCE SYSTEM</h1>

    <form action="{{ route('attendance') }}" method="POST" class="mx-auto bg-white p-4 rounded shadow-sm" style="max-width: 600px;">
        @csrf

        <div class="mb-3">
            <input type="text" id="student_id" name="student_id" placeholder="ENTER YOUR ID:" required class="form-control">
        </div>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-center gap-2 flex-wrap">

            @if ($show_morning_in)
                <button type="submit" name="morning_in" class="btn btn-success">Morning Time In</button>
            @endif

            @if ($show_morning_out)
                <button type="submit" name="morning_out" class="btn btn-danger">Morning Time Out</button>
            @endif

            @if ($show_afternoon_in)
                <button type="submit" name="afternoon_in" class="btn btn-success">Afternoon Time In</button>
            @endif

            @if ($show_afternoon_out)
                <button type="submit" name="afternoon_out" class="btn btn-danger">Afternoon Time Out</button>
            @endif

        </div>
    </form>

</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('button');
        const inputField = document.getElementById('student_id');
        let isButtonVisible = false;

        buttons.forEach(button => {
            if (getComputedStyle(button).display !== 'none') {
                isButtonVisible = true;
            }
        });

        if (!isButtonVisible) {
            inputField.disabled = true;
        }
    });
</script>

</body>
</html>
