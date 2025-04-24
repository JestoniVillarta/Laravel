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
                position: relative;
            }

            .student-card:hover {
                transform: scale(1.05);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            }

            .student-name {
                font-weight: bold;
                font-size: 28px;
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

            /* Trophy styling */
            .trophy {
                position: absolute;
                right: -50px;
                top: 50%;
                transform: translateY(-50%);
                font-size: 36px;
            }

            /* Special styling for the top student */
            .top-student {
                background: #e0f3ff;
                padding: 2rem 2rem;
                width: 85%;
                margin-right: 50px;
            }

            .top-student .student-name {
                font-size: 36px;
            }

            .top-student .total-hours {
                font-size: 26px;
                font-weight: bold;
                color: #005b96;
            }

            /* Styling for second place */
            .second-student {
                background: #f0f0f0;
                padding: 1.8rem 1.8rem;
                width: 80%;
                margin-right: 50px;
            }

            .second-student .student-name {
                font-size: 32px;
            }

            .second-student .total-hours {
                font-size: 24px;
                font-weight: bold;
                color: #777;
            }

            /* Styling for third place */
            .third-student {
                background: #faf3e0;
                padding: 1.6rem 1.6rem;
                width: 78%;
                margin-right: 50px;
            }

            .third-student .student-name {
                font-size: 30px;
            }

            .third-student .total-hours {
                font-size: 22px;
                font-weight: bold;
                color: #b87333;
            }

            /* All other students smaller and centered */
            .other-students {
                width: 75%;
                margin-top: 2rem;

            }

            @media (max-width: 768px) {
                .ranking-container {
                    padding: 1rem 0.5rem;
                }

                .top-student, .second-student, .third-student {
                    padding: 1.5rem;
                    margin-right: 40px;
                }

                .top-student .student-name {
                    font-size: 40px;
                }

                .top-student .total-hours {
                    font-size: 22px;
                }

                .second-student .student-name, .third-student .student-name {
                    font-size: 36px;
                }

                .second-student .total-hours, .third-student .total-hours {
                    font-size: 20px;
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

                .trophy {
                    right: -40px;
                    font-size: 30px;
                }
            }
        </style>
    </head>

    <body>
        <div class="ranking-container bg-white rounded shadow-sm mt-4">

            <div class="d-flex justify-content-between mb-5 flex-wrap">
                <h2>Student Duty Hours (All-Time)</h2>
            </div>

            <!-- Student Cards -->
            @forelse($rankings as $index => $student)
                @php
                    $cardClass = 'other-students';
                    $trophy = '';

                    if ($index === 0) {
                        $cardClass = 'top-student';
                        $trophy = '🏆';
                    } elseif ($index === 1) {
                        $cardClass = 'second-student';
                        $trophy = '🥈';
                    } elseif ($index === 2) {
                        $cardClass = 'third-student';
                        $trophy = '🥉';
                    }
                @endphp

                <div class="student-card {{ $cardClass }}">
                    @if(!empty($trophy))
                        <div class="trophy">{{ $trophy }}</div>
                    @endif

                    <div class="d-flex justify-content-between">
                        <div class="student-id"><strong>Student ID:</strong> {{ $student->student_id }}</div>
                        <div class="total-hours-label"><strong>Total Hours</strong></div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
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
