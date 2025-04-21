<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance</title>

    <!-- Laravel Vite -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .hidden {
            display: none;
        }

        .custom-card {
            max-width: 80%;
            height: 400px;
            margin: auto;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            display: flex;
            flex-direction: column;

            justify-content: center;
        }

        .custom-heading {
            font-size: 2.8rem;
            font-weight: 800;
            color: #0d6efd;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        label {
            font-size: 30px;
        }

        .form-control {
            height: 80px;
            font-size: 30px;
        }

        .btn {
            min-width: 150px;
            height: 50px;
            font-weight: 600;
            font-size: 1rem;
            margin-top: 4rem;
        }

        .btn-success {
            background-color: #198754;
            border-color: #198754;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        /* Add fade-out animation */
        .fade-out {
            animation: fadeOut 2.5s forwards;
        }

        @keyframes fadeOut {
            0% { opacity: 1; }
            70% { opacity: 1; } /* Stay visible for 70% of animation time */
            100% { opacity: 0; }
        }

        /* Style for the message when no buttons are available */
        .no-buttons-message {
            text-align: center;
            font-size: 24px;
            color: #6c757d;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-5 custom-heading">Trainee Attendance System</h1>

        <form action="{{ route('attendance') }}" method="POST" class="custom-card">
            @csrf

            <div class="d-flex justify-content-center">
                <div class="input mb-4" style="width: 100%; max-width: 600px;">
                    <label for="student_id" class="form-label fw-semibold text-start w-100">Enter Your ID:</label>
                    <input type="text" id="student_id" name="student_id" placeholder="e.g., 123456" required
                        class="form-control form-control-lg" {{ !($show_morning_in || $show_morning_out || $show_afternoon_in || $show_afternoon_out) ? 'disabled' : '' }}>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success text-center fade-out" id="success-alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger text-center fade-out" id="error-alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="sub-btn d-flex flex-wrap justify-content-center gap-3">
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

            @if (!($show_morning_in || $show_morning_out || $show_afternoon_in || $show_afternoon_out))
                <div class="no-buttons-message">
                    No attendance options available at this time.
                </div>
            @endif
        </form>
    </div>

    <script>
        // Add JavaScript to handle the fade-out and removal
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');
            const studentIdInput = document.getElementById('student_id');
            const buttonsContainer = document.querySelector('.d-flex.flex-wrap.justify-content-center');

            // Function to handle fade-out and removal
            function handleAlerts(alertElement) {
                if (alertElement) {
                    // Set a timeout to remove the element after animation
                    setTimeout(function() {
                        alertElement.style.display = 'none';
                    }, 2500); // 2.5 seconds matches our animation duration
                }
            }

            // Check if any buttons are present
            function checkButtons() {
                // If no buttons are visible, disable the input
                if (buttonsContainer && buttonsContainer.children.length === 0) {
                    studentIdInput.disabled = true;
                } else {
                    studentIdInput.disabled = false;
                }
            }

            // Run initially
            checkButtons();

            // Apply to both alerts
            handleAlerts(successAlert);
            handleAlerts(errorAlert);
        });
    </script>
</body>
</html>
