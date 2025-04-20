<x-navigation>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Student Duty Hours</title>

        <style>
            .ranking-container {
                width: 95%;
                margin: 0 auto;
                padding: 1.5rem;
                box-sizing: border-box;
            }

            .search-container input {
                width: 100%;
                padding: 0.5rem;
                border-radius: 500px;
            }

            .student-card {
                background-color: #f8f9fa;
                border-radius: 1rem;
                padding: 1rem 1.5rem;
                margin-bottom: 1rem;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
                display: flex;
                flex-direction: column;
                gap: 0.3rem;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .student-card:hover {
                transform: scale(1.05);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            }

            .student-name {
                font-weight: bold;
                font-size: 40px;
                display: flex;
                align-items: center;
            }

            .total-hours-label {
                color: #6c757d;
            }

            .total-hours {
                font-weight: bold;
                color: #333;
                text-align: right;
            }

            /* Special styling for the top student */
            .top-student {
                background: #e0f3ff;

                padding: 2rem 2rem;
                width: 100%;
            }

            .top-student .student-name {
                font-size: 46px;
            }

            .top-student .total-hours {
                font-size: 26px;
                font-weight: bold;
                color: #005b96;
            }

            /* All other students smaller and centered */
            .other-students {
                width: 96%;
                margin: 0 auto;
                margin-top: 2rem;
            }

            @media (max-width: 768px) {
                .ranking-container {
                    padding: 1rem 0.5rem;
                }

                .top-student {
                    padding: 1.5rem;
                }

                .top-student .student-name {
                    font-size: 40px;
                }

                .top-student .total-hours {
                    font-size: 22px;
                }

                .student-name {
                    font-size: 32px;
                }

                .total-hours {
                    font-size: 18px;
                }

                .other-students {
                    width: 100%;
                }
            }
        </style>
    </head>

    <body>
        <div class="ranking-container bg-white rounded shadow-sm mt-4">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                <h2>Student Duty Hours (All-Time)</h2>

            </div>



            <!-- Student Cards -->
            @forelse($rankings as $index => $student)
                @php
                    $isTop = $index === 0;
                @endphp

                <div class="student-card {{ $isTop ? 'top-student' : 'other-students' }}">
                    <div class="d-flex justify-content-between">
                        <div class="student-id"><strong>Student ID:</strong> {{ $student->student_id }}</div>
                        <div class="total-hours-label"><strong>Total Hours</strong></div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="student-name">{{ $student->name }}</div>
                        <div class="total-hours">{{ number_format($student->total_duty_hours, 2) }}</div>
                    </div>
                </div>
            @empty
                <div class="text-center py-4">No student records available.</div>
            @endforelse
        </div>
    </body>

    </html>
</x-navigation>
