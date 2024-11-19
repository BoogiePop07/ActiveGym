<?php
session_start();
require 'database.php'; // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['member_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit;
}

// Fetch user data from the database
$member_id = $_SESSION['member_id'];
$query = "SELECT first_name, last_name, email, contact_number, birthdate, profile_picture, join_date FROM members WHERE member_id = ?";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("i", $member_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    die("Error executing query: " . $stmt->error);
}

$member = $result->fetch_assoc();

if ($member === null) {
    die("Member not found.");
}

// Initialize message variable
$message = "";

// Update user profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $contact_number = trim($_POST['contact_number']);
    $birthdate = trim($_POST['birthdate']);

    // Handle profile picture upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";

        // Make sure the uploads directory exists and is writable
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
        if ($check === false) {
            $message = "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $message = "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size (example: limit to 5MB)
        if ($_FILES["profile_picture"]["size"] > 5000000) {
            $message = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) 
        {
            $message .= " Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                $profile_picture = $target_file; // Store the path to the uploaded image

                // Update the profile picture path in the database
                $update_picture_query = "UPDATE members SET profile_picture = ? WHERE member_id = ?";
                $update_picture_stmt = $conn->prepare($update_picture_query);
                $update_picture_stmt->bind_param("si", $profile_picture, $member_id);

                if ($update_picture_stmt->execute()) {
                    $message .= " The file " . htmlspecialchars(basename($_FILES["profile_picture"]["name"])) . " has been uploaded.";
                    $member['profile_picture'] = $profile_picture; // Update the profile picture in the $member array
                } else {
                    $message .= " Sorry, there was an error uploading your file.";
                }

                $update_picture_stmt->close();
            } else {
                $message .= " Sorry, there was an error uploading your file.";
            }
        }
    }

    // Validate input 
    if (!empty($first_name) && !empty($last_name) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $update_query = "UPDATE members SET first_name = ?, last_name = ?, email = ?, contact_number = ?, birthdate = ? WHERE member_id = ?";
        $update_stmt = $conn->prepare($update_query);

        if ($update_stmt === false) {
            die("Error preparing update statement: " . $conn->error);
        }

        $update_stmt->bind_param("sssssi", $first_name, $last_name, $email, $contact_number, $birthdate, $member_id);

        if ($update_stmt->execute()) {
            $message .= " Profile updated successfully!";
            $member['first_name'] = $first_name;
            $member['last_name'] = $last_name;
            $member['email'] = $email;
            $member['contact_number'] = $contact_number;
            $member['birthdate'] = $birthdate; 
        } else {
            $message .= " Error updating profile: " . $update_stmt->error;
        }
        $update_stmt->close();
    } else {
        $message .= " Invalid input.";
    }
}
?>

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
      <?php if (isset($member['profile_picture']) && !empty($member['profile_picture'])): ?>
        <img alt="Profile picture" height="100" src="<?php echo htmlspecialchars($member['profile_picture']); ?>" width="100" />
      <?php else: ?>
        <img alt="Profile picture" height="100" src="https://via.placeholder.com/100" width="100" />
      <?php endif; ?>

      <button class="edit-profile-button" type="button" onclick="window.location.href='edit-profile.php'">
        <i class="fas fa-edit"></i> Edit Profile
      </button>

      <h2>
        <?php
        // Display the member's full name if available, otherwise show a default value
        if (isset($member['first_name']) && isset($member['last_name'])) {
          echo htmlspecialchars($member['first_name'] . ' ' . $member['last_name']);
        } else {
          echo "Member Name"; 
        }
        ?>
      </h2>

      <div class="status">Active</div>
      <p>Member since 
        <?php
        // Display the join date if available, otherwise show a message
        if (isset($member['join_date'])) {
          echo date('m/d/Y', strtotime($member['join_date']));
        } else {
          echo "Join date not available"; 
        }
        ?>
      </p>

      <div class="qr-code">
        <div id="qrcode"></div>
        <p onclick="window.location.href='https://example.com/checkin'">Check-In QR</p>
      </div>

      <div class="info">
        <h3>Personal Information</h3>
        
        <div>
          <span>Birthday:</span>
          <span>
            <?php 
            // Display the birthdate if available, otherwise show a message
            if (isset($member['birthdate'])) {
              echo htmlspecialchars($member['birthdate']);
            } else {
              echo "Birthdate not available"; 
            }
            ?>
          </span>
          </div>
        
        <div>
          <span>Phone Number:</span>
          <span>
            <?php 
            // Display the contact number if available, otherwise show a message
            if (isset($member['contact_number'])) {
              echo htmlspecialchars($member['contact_number']);
            } else {
              echo "N/A"; 
            }
            ?>
          </span>
        </div>
        
        <div>
          <span>Email:</span>
          <span>
            <?php 
            // Display the email if available, otherwise show a message
            if (isset($member['email'])) {
              echo htmlspecialchars($member['email']);
            } else {
              echo "N/A"; 
            }
            ?>
          </span>
        </div>

      </div>

      <div class="billing">
        <h3>Billing Details</h3>
        <div>
          <img alt="Visa logo" height="50" src="https://via.placeholder.com/50" width="50">
          <span>Credit Card - Visa</span>
        </div>
        <div>
          <img alt="GCash logo" height="50" src="https://via.placeholder.com/50" width="50">
          <span class="default">GCash</span>
        </div>
      </div>
    </div>

    <div class="main-content">
      <div class="logout">
        <button type="button" onclick="window.location.href='login.php'">Logout</button>
      </div>

      <div class="attendance">
        <h3>Attendance</h3>
        <canvas id="attendanceChart" width="400" height="200"></canvas>
        <script>
          // Replace the example data with your actual attendance data
          const attendanceData = [
            {x: 'Aug 1', y: 4},
            {x: 'Aug 2', y: 3.5},
            {x: 'Aug 3', y: 3},
            {x: 'Aug 4', y: 2.5},
            {x: 'Aug 5', y: 2},
            {x: 'Aug 6', y: 1.5},
            {x: 'Aug 7', y: 1},
            {x: 'Aug 8', y: 1.5},
            {x: 'Aug 9', y: 2},
            {x: 'Aug 10', y: 1}
          ];

          const ctx = document.getElementById('attendanceChart').getContext('2d');
          const attendanceChart = new Chart(ctx, {
            type: 'line',
            data: {
              datasets: [{
                label: 'Attendance',
                data: attendanceData,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: false,
                tension: 0.4 // Add tension for smoother curves
              }]
            },
            options: {
              scales: {
                x: {
                  type: 'category', // Use category scale for labels
                  title: {
                    display: true,
                    text: 'Date'
                  }
                },
                y: {
                  beginAtZero: true,
                  title: {
                    display: true,
                    text: 'Hours'
                  }
                }
              }
            }
          });
        </script>
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
          <div><span>Amount : ₱1600</span></div>
          <div>
            <span>Start Date: 03/29/23</span>
            <span>Next Payment: 04/27/23</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Generate QR Code
    var qrcode = new QRCode(document.getElementById("qrcode"), {
      text: "https://example.com/checkin",
      width: 100,
      height: 100,
      colorDark: "#000000",
      colorLight: "#ffffff",
      correctLevel: QRCode.CorrectLevel.H,
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
      height: 100vh;
    }

    .sidebar {
    width: 300px;
    background-color: #2c6d7a; /* This is the teal color from the image */
    color: white;
    padding: 10px;
    box-sizing: border-box;
    text-align: center;
    }

    .sidebar img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      display: block;
      margin: 0 auto 10px auto;
    }

    .sidebar .status {
      background-color: #28a745;
      color: white;
      padding: 5px 10px;
      border-radius: 5px;
      margin: 10px auto;
      display: inline-block;
    }

    .sidebar h2 {
      margin: 10px 0;
    }

    .sidebar .qr-code {
      margin: 20px 0;
    }

    .sidebar .qr-code p {
      color: #007bff;
      cursor: pointer;
      text-decoration: underline;
      margin-top: 5px;
    }

    .sidebar .info {
      margin-top: 20px;
    }

    .sidebar .info div {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    justify-content: flex-start;
    }

    .sidebar .billing {
      margin-top: 20px;
    }

    .sidebar .billing p {
      margin-bottom: 10px;
    }

    .sidebar .billing div {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        justify-content: flex-start; /* Align items to the left */
    }

    .sidebar .billing img {
        margin-right: 10px;
        vertical-align: middle; /* Vertically align the image within the line */
        float: left; /* Float the image to the left */
    }

    .main-content {
      flex-grow: 1;
      padding: 20px;
      box-sizing: border-box;
      overflow-y: auto;
    }

    .main-content .logout {
      text-align: right;
      margin-bottom: 20px;
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
      margin-bottom: 20px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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

    .membership-plan .content div,
    .recurring-payments .content div {
      margin-bottom: 10px;
    }

    .membership-plan .cancel {
      color: #dc3545;
      text-align: right;
    }

    /* Hover effect for the edit profile button */
    .edit-profile-button:hover {
      background-color: #0056b3;
      cursor: pointer;
    }

    /* Media query for responsiveness */
    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
      }

      .main-content {
        width: 100%;
      }
    }
    </style>