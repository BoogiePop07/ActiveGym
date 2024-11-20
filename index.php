<?php
// Check if a session has already been started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Include header2.php if the user is logged in
    include 'header2.php'; 
} else {
    // Include header.php if the user is not logged in
    include 'header.php'; 
}
?>

<!DOCTYPE html>
<html>
<body>
<title>
   MTFC
  </title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>

<div class="background-image"></div>
<div class="content">
    <h1>Manila Total Fitness Center:</h1>
    <h2>Your Fitness Journey Starts Here</h2>
    <p>Achieve your fitness goals with personalized plans, real-time availability updates, and a supportive community.</p>
</div>


<?php include 'footer.php'; ?>

  <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #1a202c;
            color: white;
            margin: 0;
            padding: 0;
        }
        .background-image {
            position: relative;
            width: 100%;
            height: 100vh;
            background: url('https://storage.googleapis.com/a1aa/image/8vljVJNn4m63NdAMqxWohg5QLCICL7W3hHLq0cpLARO5bq7E.jpg') no-repeat center center/cover;
            opacity: 0.5;
        }
        .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            padding: 0 1rem;
        }
        .content h1 {
            font-size: 2.5rem;
            font-weight: 700;
        }
        .content h2 {
            font-size: 1.5rem;
            margin-top: 0.5rem;
        }
        .content p {
            margin-top: 1rem;
            font-size: 1.125rem;
        }
        .images {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
            gap: 1rem;
            padding: 0 1rem;
        }
        .images img {
            width: 30%;
            object-fit: cover;
        }
        @media (min-width: 768px) {
            .content h1 {
                font-size: 4rem;
            }
            .content h2 {
                font-size: 2rem;
            }
            .content p {
                font-size: 1.25rem;
            }
        }
  </style>


</body>
</html>
