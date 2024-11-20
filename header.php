<?php
// Check if a session has already been started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Assuming you have a login form that submits to this script
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    require_once "database.php"; 

    // Get username and password from POST request
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Validate credentials against the 'members' table (using first_name)
    $sql = "SELECT member_id, first_name, profile_picture FROM members WHERE first_name = ? AND password = ?"; 
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        // Check if the user exists
        if (mysqli_stmt_num_rows($stmt) == 1) {
            // Bind result variables
            mysqli_stmt_bind_result($stmt, $member_id, $first_name, $profile_picture);
            mysqli_stmt_fetch($stmt);

            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["member_id"] = $member_id; // Store the member ID
            $_SESSION["first_name"] = $first_name; // Store the first name
            $_SESSION["profile_picture"] = $profile_picture; 

            // Redirect to user profile
            header("location: profile.php");
            exit;
        } else {
            // Handle login failure
            echo "Invalid username or password.";
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}
?>



<!DOCTYPE html>
<html>
<title>
    MTFC
</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
<body>
    <div class="navbar">
        <div class="logo">
            <img alt="MTFC logo with stylized text" src="images/MTFC_LOGO.PNG" width="150"/>
        </div>
        <ul class="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="trainer.php">Trainers</a></li>
            <li><a href="price.php">Pricing</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <div class="auth">
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <span class="welcome-message">Welcome, <?php echo htmlspecialchars($_SESSION['first_name']); ?>!</span> 
                <?php if (isset($_SESSION['profile_picture']) && !empty($_SESSION['profile_picture'])): ?>
                    <img src="<?php echo htmlspecialchars($_SESSION['profile_picture']); ?>" alt="Profile Picture" style="width: 40px; height: 40px; border-radius: 50%;">
                <?php endif; ?>
                <a href="profile.php">
                    <i class="fas fa-user-circle"></i>
                </a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<style>
  body {
    margin: 0;
    font-family: Arial, sans-serif;
  }
  .navbar {
    background-color: #666;
    padding: 10px 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .navbar .logo {
    margin-left: 20px;
  }
  .navbar .logo img {
    height: 50px; /* Medium size */
  }
  .navbar .menu {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
  }
  .navbar .menu li {
    margin: 0 15px;
  }
  .navbar .menu li a {
    color: white;
    text-decoration: none;
    font-size: 16px;
  }
  .navbar .auth {
    margin-right: 20px;
    display: flex;
    align-items: center;
  }
  .navbar .auth a {
    color: white;
    text-decoration: none;
    font-size: 16px;
    margin-right: 10px;
  }
  .navbar .auth .fa-user-circle {
    font-size: 30px; 
  }
</style>