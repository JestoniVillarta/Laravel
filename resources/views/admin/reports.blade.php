
<x-Navigation>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Reports</title>
        <style>
            .reports-wrapper {
                width: 95%;
                font-size: 15px;
                margin: 0 auto;
                margin-top: 3rem;
                padding: 1.5rem;
                box-sizing: border-box;
            }

            .report-flex {
                display: flex;
                flex-wrap: wrap;
                gap: 1.5rem;
                margin-top: 2rem;
                justify-content: center; /* Center align the report boxes */
            }

            .report-box {
                background-color: #f9f9f9;
                padding: 1.5rem;
                border-radius: 10px;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
                transition: transform 0.2s;
                cursor: pointer;
                width: 250px; /* Ensures same width for all boxes */
                box-sizing: border-box;
                display: flex;
                flex-direction: column;
                height: 250px; /* Fixed height for all boxes */
                position: relative; /* Added for positioning of button */
            }

            .report-box:hover {
                transform: translateY(-5px);
            }

            .report-icon {
                font-size: 2rem;
                margin-bottom: 1rem;
            }

            .report-content {
                flex-grow: 1; /* Takes up available space */
            }

            .check-button {
                padding: 8px 16px;
                background-color: #e2e3e5; /* bg-dark-subtle color */
                color: #212529; /* Darker text for better contrast on lighter bg */
                text-decoration: none;
                border-radius: 5px;
                font-weight: bold;
                text-align: center;
                display: block;
                width: 100%;
                box-sizing: border-box;
                position: absolute;
                bottom: 1.5rem; /* Aligns with bottom padding */
                left: 0;
                right: 0;
                margin: 0 1.5rem; /* Matches the padding of report-box */
                width: calc(100% - 3rem); /* Accounts for the left and right margin */
            }

            .check-button:hover {
                background-color: #d2d4d7; /* Slightly darker on hover */
            }
        </style>
    </head>

    <body>

        <div class="reports-wrapper bg-white rounded shadow-sm mt-4">
            <h2>Reports</h2>

            <div class="report-flex">
                <div class="report-box">
                    <div class="report-content">
                        <div class="report-icon">🗓️</div>
                        <h4>Daily Attendance Summary</h4>
                        <p>Get an overview of daily attendance records and trends.</p>
                    </div>
                    <a href="daily-attendance-summary.html" class="check-button">✔️ Check</a>
                </div>
                <div class="report-box">
                    <div class="report-content">
                        <div class="report-icon">👤</div>
                        <h4>Individual Student Attendance Report</h4>
                        <p>View detailed attendance data for each student.</p>
                    </div>
                    <a href="individual-student-report.html" class="check-button">✔️ Check</a>
                </div>
                <div class="report-box">
                    <div class="report-content">
                        <div class="report-icon">🚫</div>
                        <h4>Absenteeism Report</h4>
                        <p>Analyze absence patterns and identify frequent absentees.</p>
                    </div>
                    <a href="absenteeism-report.html" class="check-button">✔️ Check</a>
                </div>
                <div class="report-box">
                    <div class="report-content">
                        <div class="report-icon">⏰</div>
                        <h4>Duty Hours Analysis</h4>
                        <p>Monitor and evaluate staff or student duty hours.</p>
                    </div>
                    <a href="duty-hours-analysis.html" class="check-button">✔️ Check</a>
                </div>
                <div class="report-box">
                    <div class="report-content">
                        <div class="report-icon">📅</div>
                        <h4>Monthly Attendance Reports</h4>
                        <p>Track attendance trends over the month or semester.</p>
                    </div>
                    <a href="monthly-semester-dashboard.html" class="check-button">✔️ Check</a>
                </div>
            </div>

        </div>

    </body>

    </html>

</x-Navigation>
