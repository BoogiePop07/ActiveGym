<!DOCTYPE html>
<html>
<head>
  <title>Fitness Pricing Table</title>
  <link rel="stylesheet" href="pricing.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="pricing-table">
  <h2>Fitness Pricing Table</h2>

  <div class="categories">
      <a href="price.php" class="category">GYM</a>
      <a href="boxing.php" class="category">Boxing</a>
      <a href="muay-thai.php" class="category">Muay Thai</a>
      <a href="taekwando.php" class="category active">Taekwondo</a>
    </div>


  <div class="plans">
    <div class="plan">
      <div class="schedule">
        <h4>Saturday & Sunday</h4>
        <p>Session 9:00AM</p>
      </div>
      <h3>4 Sessions</h3>
      <div class="includes">
        <h4>Includes:</h4>
        <ul>
          <li>Access to gym equipment</li>
          <li>Use of locker room facilities</li>
        </ul>
      </div>
      <div class="price">P 2,500</div>
      <button onclick="window.location.href='payment.php'">Join now!</button>
    </div>

    <div class="plan">
      <div class="schedule">
        <h4>Saturday & Sunday</h4>
        <p>Session 9:00AM</p>
      </div>
      <h3>8 Sessions</h3>
      <div class="includes">
        <h4>Includes:</h4>
        <ul>
          <li>Access to gym equipment</li>
          <li>Use of locker room facilities</li>
        </ul>
      </div>
      <div class="price">P 4,000</div>
      <button onclick="window.location.href='payment.php'">Join now!</button>

    </div>
  </div>
</div>

<script>
    const categories = document.querySelectorAll('.category');
    const whiteBox = document.createElement('div');
    whiteBox.classList.add('white-box');
    categories[0].appendChild(whiteBox);

    categories.forEach(category => {
      category.addEventListener('click', () => {
        categories.forEach(cat => cat.classList.remove('active'));
        category.classList.add('active'); 

        category.appendChild(whiteBox);
      });
    });
  </script>

  <?php include 'footer.php'; ?>


</body>
</html>

<style>
   body {
      font-family: sans-serif;
      background-color: #222;
    }

    .pricing-table {
      width: 90%;
      max-width: 1200px;
      margin: 50px auto;
      background-color: #333;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }

    .pricing-table h2 {
      text-align: center;
      color: white;
      margin-bottom: 30px;
      font-size: 2em;
    }

    .categories {
  display: flex;
  justify-content: center;
  margin-bottom: 40px; 
  flex-wrap: wrap; 
}

.category {
  padding: 12px 24px; 
  background-color: #444;
  color: white;
  border-radius: 5px;
  margin: 10px;
  cursor: pointer;
  text-decoration: none; 
  font-size: 1.2em; 
  white-space: nowrap; 
}
    .category.active {
      background-color: #666;
    }

    
    .plans {
      display: flex;
      justify-content: center;
      flex-wrap: wrap; /* Allow wrapping on smaller screens */
      gap: 20px; /* Add some space between the plans */
    }

    .plan {
      width: calc(50% - 20px); /* Two plans per row with spacing */
      max-width: 350px;
      background-color: white;
      color: #333;
      padding: 30px;
      border-radius: 10px;
      margin: 0; /* Remove default margin */
      height: auto;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .plan h3 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 2em;
    }

    .plan ul {
      list-style: disc;
      padding-left: 40px;
      margin-bottom: 30px;
      word-wrap: break-word;
      font-size: 1.2em;
    }

    .plan .price {
      text-align: center;
      font-size: 36px;
      margin-bottom: 30px;
      font-weight: bold;
    }

    .plan button {
      background-color: #007bff;
      color: white;
      padding: 12px 24px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      display: block;
      width: 100%;
      font-size: 1.2em;
    }

    /* Media query for smaller screens */
    @media (max-width: 768px) {
      .pricing-table {
        width: 100%;
        padding: 20px;
      }

      .plan {
        width: 100%; /* Make plans take full width on small screens */
      }
    }
</style>