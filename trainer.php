<!DOCTYPE html>
<html>
<head>
  <title>Choose Your Personal Trainer</title>
  </head>
  <body>

  <?php include 'header.php'; ?>

<div class="hero-image">
  <img src="images/gym-trainer.png" alt="Hero Image">
  <div class="hero-text">
    <h1>Choose your Personal Trainer</h1>
    <h2>in MANILA TOTAL FITNESS</h2>
  </div>
</div>

<div class="categories">
    <a href="trainer.php" class="category">Gym</a>
    <a href="boxing-trainer.php" class="category">Boxing</a>
    <a href="muay-trainer.php" class="category">Muay Thai</a>
    <a href="taekwondo-trainer.php" class="category">Taekwondo</a>
</div>

  <div class="trainer-container">
    <h2>OUR TEAM</h2>

    <div class="trainers">
      <div class="trainer">
        <img src="trainer1.jpg" alt="Trainer 1">
        <h4>John Doe</h4>
        <p>Certified Personal Trainer</p>
        <div class="specialties">
          <span>Weight Loss</span>
          <span>Muscle Gain</span>
          <span>Strength Training</span>
        </div>
        <div class="schedule">
          <p><strong>Mon-Fri:</strong> 9:00 AM - 5:00 PM</p>
        </div>
      </div>

      <div class="trainer">
        <img src="trainer2.jpg" alt="Trainer 2">
        <h4>Jane Smith</h4>
        <p>Certified Yoga Instructor</p>
        <div class="specialties">
          <span>Yoga</span>
          <span>Flexibility</span>
          <span>Mindfulness</span>
        </div>
        <div class="schedule">
          <p><strong>Tue & Thu:</strong> 10:00 AM - 12:00 PM</p>
          <p><strong>Sat:</strong> 8:00 AM - 10:00 AM</p>
        </div>
      </div>

      <div class="trainer">
        <img src="trainer3.jpg" alt="Trainer 3">
        <h4>Alice Johnson</h4>
        <p>Certified Pilates Instructor</p>
        <div class="specialties">
          <span>Pilates</span>
          <span>Core Strength</span>
          <span>Posture</span>
        </div>
        <div class="schedule">
          <p><strong>Mon, Wed & Fri:</strong> 1:00 PM - 4:00 PM</p>
        </div>
      </div>

    </div>
  </div>

  <?php include 'footer.php'; ?>
  

</body>
</html>
<style>
   body {
      font-family: sans-serif;
      margin: 0;
    }
    .hero-image {
      position: relative;
      width: 100%;
      height: 400px; /* Adjust as needed */
      overflow: hidden; /* Hide overflowing image */
    }

    .hero-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .hero-text {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
      color: white;

    }

    .hero-image h1 {
      font-size: 3em;
      margin-bottom: 10px;
    }

    .hero-image h2 {
      font-size: 2em;
      color: #00c853; /* Teal color */
    }

    .categories {
      background-color: #333;
      padding: 20px;
      text-align: center;
      display: flex; /* Make categories flex container */
      justify-content: center; /* Center the categories */
      width: 100%;
    }

    .categories a {
      display: inline-block;
      padding: 10px 20px;
      margin: 0 10px;
      color: white;
      text-decoration: none;
      font-weight: bold;
    }

    .trainer-container {
      width: 100%;
      margin: 0;
      background-color: white;
      padding: 30px;
      box-sizing: border-box;
    }

    .trainer-container h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    .trainers {
      display: flex;
      justify-content: center; /* Center the trainers */
      flex-wrap: wrap;
      gap: 20px;
    }

    .trainer {
      width: calc(33.33% - 20px); /* Three trainers per row with spacing */
      margin-bottom: 30px;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 5px;
      background-color: #fff;
      text-align: center;
    }

    .trainer img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 10px;
    }

    .trainer h4 {
      margin-bottom: 5px;
    }

    .trainer p {
      font-size: 14px;
      line-height: 1.5;
    }

    .trainer .specialties {
      margin-top: 10px;
    }

    .trainer .specialties span {
      display: inline-block;
      background-color: #eee;
      padding: 5px 10px;
      border-radius: 5px;
      margin: 5px;
      font-size: 12px;
    }

    .trainer .schedule { /* New class for the schedule */
      margin-top: 10px; /* Add some space above the schedule */
      font-size: 14px; /* Adjust font size as needed */
    }

    /* Media query for responsiveness */
    @media (max-width: 768px) {
      .trainers .trainer {
        width: calc(50% - 20px); /* Two trainers per row on smaller screens */
      }
    }

    @media (max-width: 480px) {
      .trainers .trainer {
        width: 100%; /* One trainer per row on very small screens */
      }
    }
  </style>