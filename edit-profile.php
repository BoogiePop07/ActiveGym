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
$query = "SELECT first_name, last_name, email, contact_number, birthdate, profile_picture FROM members WHERE member_id = ?";
$stmt = $conn->prepare($query);

// Error handling for prepare statement
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("i", $member_id);
$stmt->execute();
$result = $stmt->get_result();

// Error handling for query execution
if ($result === false) {
    die("Error executing query: " . $stmt->error);
}

$member = $result->fetch_assoc();

// Check if user data was fetched
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

    // Redirect back to profile.php after processing the form
    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Profile</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
    body {
      font-family:Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f0f0f0; /* Light gray background */
    }

    .container {
      display: flex;
      justify-content: center; /* Center the form horizontally */
      align-items: center; /* Center the form vertically   
 */
      height: 100vh;
    }

    .edit-profile {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      width: 400px; /* Adjust width as needed */
      text-align: center; /* Center align the content */
      position: relative; /* To position the close button */
    }

    .edit-profile h3 {
      margin-bottom: 20px;
      color: #333;
    }

    .edit-profile img {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  object-fit: cover; 
  display: block; /* Add this property */
  margin: 0 auto 10px auto; /* Center the image horizontally */
}

    .form-group { 
      text-align: left; 
    }

    .edit-profile .change-photo {
      background-color: #007bff; /* Blue background */
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 5px;
      cursor: pointer;
      margin-bottom: 20px;
    }

    .edit-profile input[type="text"],
    .edit-profile input[type="email"],
    .edit-profile input[type="date"],
    .edit-profile input[type="number"] {
      width: calc(100% - 22px); /* Adjust for padding and border */
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    .edit-profile .birthdate-container {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .edit-profile .birthdate-container input {
      width: calc(100% - 52px); /* Adjust for padding, border, and icon */
    }

    .edit-profile .birthdate-container i {
      position: relative;
      left: -30px; /* Adjust position as needed */
      pointer-events: none; /* Prevent interaction with the icon */
    }

    .edit-profile .phone-container {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .edit-profile .phone-container input {
      width: calc(100% - 52px); /* Adjust for padding, border, and icon */
    }

    .edit-profile .phone-container i {
      position: relative;
      left: -30px; /* Adjust position as needed */
      pointer-events: none; /* Prevent interaction with the icon */
    }

    .edit-profile .submit-button {
      background-color: #28a745; /* Green background */
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 20px;
      display: block; /* Make it a block-level element */
      width: 100%; /* Make it take full width */
    }

    .close-button {
      position: absolute;
      top: 10px;
      right: 10px;
      background-color: transparent;
      border: none;
      font-size: 20px;
      cursor: pointer; 

    }
  </style>
</head>
<body>
<div class="container">
    <div class="edit-profile">
      <h3>Edit Profile</h3>

      <?php if (isset($member['profile_picture']) && !empty($member['profile_picture'])): ?>
        <img alt="Profile picture" height="100" src="<?php echo htmlspecialchars($member['profile_picture']); ?>" width="100"/>
      <?php else: ?>
        <img alt="Profile picture" height="100" src="https://via.placeholder.com/100" width="100"/>
      <?php endif; ?>

      <form action="edit-profile.php" method="post" enctype="multipart/form-data"> 
        <input type="file" id="profile_picture" name="profile_picture" accept="image/*" hidden>
        <button type="button" class="change-photo" onclick="document.getElementById('profile_picture').click()">Change Photo</button>

        <div class="form-group">
          <label for="first-name">First Name:</label>
          <input type="text" id="first-name" name="first-name" value="<?php echo htmlspecialchars($member['first_name']); ?>" placeholder="Enter your first name" required>
        </div>

        <div class="form-group"> 
          <label for="last-name">Last Name:</label>
          <input type="text" id="last-name" name="last-name" value="<?php echo htmlspecialchars($member['last_name']); ?>" placeholder="Enter your last name" required>
        </div>

        <div class="form-group">
          <label for="email">Email Address:</label>
          <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($member['email']); ?>" placeholder="Enter your email" required>
        </div>

        <div class="form-group"> 
          <div class="birthdate-container">
            <label for="birthdate">Birthday:</label>
            <input type="date" id="birthdate" name="birthdate" value="<?php echo htmlspecialchars($member['birthdate']); ?>" required>
            <i class="far fa-calendar-alt"></i>
          </div>
        </div>

        <div class="form-group">
          <div class="phone-container">
            <label for="phone">Phone Number:</label>
            <input type="number" id="phone" name="phone" value="<?php echo htmlspecialchars($member['contact_number']); ?>" placeholder="Enter your phone number" required>
            <i class="fas fa-phone"></i>
          </div>
        </div>

        <button class="submit-button" type="submit">
          <i class="fas fa-check"></i>
        </button>
      </form>

      <button class="close-button" type="button" onclick="window.location.href='profile.php'">&times;</button>
    </div>
  </div>
</body>
</html>