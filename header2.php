<?php
// Check if a session has already been started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include your database connection file
require_once "database.php";

// Check if the user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Fetch the user's first name from the database based on their member_id
    $member_id = $_SESSION['member_id'];
    $sql = "SELECT first_name FROM members WHERE member_id = ?";
    
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $member_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $first_name);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    } else {
        // Handle the case where preparing the statement fails
        echo "Error preparing statement: " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>MTFC</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
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
</head>
<body>
  <div class="navbar">
    <div class="logo">
      <img alt="MTFC logo with stylized text" src="images/MTFC_LOGO.PNG" width="150"/>
    </div>
    <ul class="menu">
      <li><a href="#">Home</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Trainers</a></li>
      <li><a href="price.php">Pricing</a></li>
      <li><a href="#">Contact</a></li>
    </ul>
    <div class="auth">
      <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
        <span class="welcome-message">Welcome, <?php echo htmlspecialchars($first_name); ?>!</span>
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