<!DOCTYPE html>
<html>
<head>
    <title>Membership Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode"></script>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <img alt="Profile picture" height="100" src="https://storage.googleapis.com/a1aa/image/idYoX7v8Iwq3Ppno94MoeBMBkO8a5txOnlBCgoztDNeUwpvTA.jpg" width="100"/>
            <div class="status">Active</div>
            <h2>Fhilip Lorenzo</h2>
            <p>Member since 03/29/2023</p>
            <div class="qr-code">
                <div id="qrcode"></div>
                <p onclick="window.location.href='https://example.com/checkin'">Check-In QR</p>
            </div>
            <div class="info">
                <div><span>Birthday</span><span>03/29/2002</span></div>
                <div><span>Phone Number</span><span>09475574266</span></div>
                <div><span>Email</span><span>fhilip@gmail.com</span></div>
            </div>
            <div class="billing">
                <p>Billing Details</p>
                <div>
                    <img alt="Visa logo" height="50" src="https://storage.googleapis.com/a1aa/image/asL8YcnvbkpbHZZyK3vSgZVZjrbAtZ65Snjbnk7VaChEc67E.jpg" width="50"/>
                    <span>Credit Card - Visa</span>
                </div>
                <div>
                    <img alt="GCash logo" height="50" src="https://storage.googleapis.com/a1aa/image/c8zvmIYdU1bPFhHI3JvghlWzWtqgsOV4rPfw7M1fyvcWwpvTA.jpg" width="50"/>
                    <span class="default">Default</span>
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="logout">
                <button type="button">Logout</button>
            </div>
            <div class="attendance">
                <h3>Attendance</h3>
                <canvas id="attendanceChart" width="400" height="200"></canvas>
            </div>
            <div class="membership-plan">
                <div class="header">
                    <h3>Membership Plan</h3>
                    <button type="button">Add</button>
                </div>
                <div class="content">
                    <div><span>Annual</span></div>
                    <div>
                        <span>Access: Unlimited</span>
                        <span>Expiry Date: 03/29/23</span>
                    </div>
                    <div>
                        <span>Start Date: 03/29/23</span>
                        <span>Cost: ₱8000</span>
                    </div>
                    <div class="cancel">Cancel membership</div>
                </div>
            </div>
            <div class="recurring-payments">
                <div class="header">
                    <h3>Recurring Payments</h3>
                </div>
                <div class="content">
                    <div><span>Manual Payment</span></div>
                    <div><span>Frequency: Every 1 month</span></div>
                    <div><span>Amount: ₱1600</span></div>
                    <div>
                        <span>Start Date: 03/29/23</span>
                        <span>Next Payment: 04/27/23</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var ctx = document.getElementById('attendanceChart').getContext('2d');
        var attendanceChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Aug 1', 'Aug 2', 'Aug 3', 'Aug 4', 'Aug 5', 'Aug 6', 'Aug 7', 'Aug 8', 'Aug 9', 'Aug 10'],
                datasets: [{
                    label: 'Attendance',
                    data: [4, 3.5, 3, 2.5, 2, 1.5, 1, 1.5, 2, 1],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Hours'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    }
                }
            }
        });

        // Generate QR Code
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: "https://example.com/checkin",
            width: 100,
            height: 100,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
    </script>
</body>
</html>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            display: flex;
            height: 100vh; /* Full height */
        }
        .sidebar {
            width: 300px; /* Fixed width for sidebar */
            background-color: #2c6d7a;
            color: white;
            padding: 20px;
            box-sizing: border-box;
        }
        .sidebar img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: block;
            margin: 0 auto;
        }
        .sidebar .status {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-align: center;
            margin: 10px 0;
        }
        .sidebar h2 {
            text-align: center;
            margin: 10px 0;
        }
        .sidebar .qr-code {
            text-align: center;
            margin: 20px 0;
        }
        .sidebar .qr-code p {
            text-align: center;
            color: #007bff;
            cursor: pointer;
            text-decoration: underline;
        }
        .main-content {
            flex-grow: 1; /* Allow main content to fill the remaining space */
            padding: 20px;
            box-sizing: border-box;
            overflow-y: auto; /* Allow scrolling if content overflows */
        }
        .main-content .logout {
            text-align: right;
        }
        .main-content .logout button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .attendance,
        .membership-plan,
        .recurring-payments {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }
        .membership-plan .header,
        .recurring-payments .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #2c6d7a;
            color: white;
            padding: 10px;
            border-radius: 10px 10px 0 0;
        }
        .membership-plan .header button,
        .recurring-payments .header button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%; /* Full width on smaller screens */
            }
            .main-content {
                width: 100%; /* Full width on smaller screens */
            }
        }
    </style>