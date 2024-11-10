<?php
// registration.php
require_once 'database.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic validation
    if (empty($first_name) || empty($last_name) || empty($gender) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Check if the email already exists in the members table
        $sql = "SELECT * FROM members WHERE email=?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt === false) {
            die("Error preparing SELECT statement: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $error = "Email is already registered.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert the new member into the members table
            $sql = "INSERT INTO members (first_name, last_name, gender, email, password) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt === false) {
                die("Error preparing INSERT statement: " . mysqli_error($conn));
            }
            mysqli_stmt_bind_param($stmt, "sssss", $first_name, $last_name, $gender, $email, $hashed_password);

            if (mysqli_stmt_execute($stmt)) {
                // Registration successful
                header('Location: login.php'); // Redirect to login page
                exit;
            } else {
                $error = "Error registering member: " . mysqli_stmt_error($stmt);
            }
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Sign Up now!</h1>
            <p>Unlock Your Potential: Join Us Today!</p>
            <?php if (isset($error)): ?>
                <div style="color: red;"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <input type="text" name="first_name" placeholder="First Name" required>
                <input type="text" name="last_name" placeholder="Last Name" required>
                <select name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
                <input type="email" name="email" placeholder="Email Address" required>
                <div class="password-container">
                    <input type="password" name="password" placeholder="Password" id="password" required>
                    <i class="fas fa-eye toggle-password" onclick="togglePassword('password')"></i>
                </div>
                <div class="password-container">
                    <input type="password" name="confirm_password" placeholder="Confirm Password" id="confirm -password" required>
                    <i class="fas fa-eye toggle-password" onclick="togglePassword('confirm-password')"></i>
                </div>
                <button type="submit">Sign Up</button>
                <p class="login-link">Already have an account? <a href="login.php">Log In</a></p>
            </form>
        </div>
        <div class="image-container">
            <!-- Image description: Three people in fitness attire posing with gym equipment -->
        </div>
    </div>
    <script>
        function togglePassword(id) {
            var input = document.getElementById(id);
            var icon = input.nextElementSibling;
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>
<style>
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: Arial, sans-serif;
    }
    .container {
        display: flex;
        height: 100%;
    }
    .form-container {
        background-color: #1c1b1b;
        color: white;
        padding: 50px;
        width: 50%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
    }
    .form-container h1 {
        font-size: 36px;
        margin-bottom: 10px;
    }
    .form-container p {
        font-size: 18px;
        margin-bottom: 30px;
    }
    .form-container input, .form-container select {
        width: 100%;
        padding: 15px;
        margin: 10px 0;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        box-sizing: border-box;
    }
    .form-container .password-container {
        position: relative;
    }
    .form-container .password-container input {
        width: 100%;
        padding-right: 40px;
    }
    .form-container .password-container .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: black;
    }
    .form-container button {
        width: 100%;
        padding: 15px;
        background-color: #4CAF50;
        border: none;
        border-radius: 5px;
        font-size: 18px;
        color: white;
        cursor: pointer;
        box-sizing: border-box;
        margin-top: 20px;
    }
    .form-container button:hover {
        background-color: #45a049;
    }
    .form-container a {
        color: #4CAF50;
        text-decoration: none;
    }
    .form-container a:hover {
        text-decoration: underline;
    }
    .form-container .login-link {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 16px;
    }
    .image-container {
        width: 55%;
        background: url('https://placehold.co/600x800') no-repeat center center;
        background-size: cover;
    }
</style>