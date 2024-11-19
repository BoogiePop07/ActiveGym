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
      <a href="muay-thai.php" class="category active">Muay Thai</a>
      <a href="taekwando.php" class="category">Taekwondo</a>
    </div>

    <div class="plans">
      <div class="plan">
        <h3>Daily</h3>
        <div class="includes">
          <h4>Includes:</h4>
          <ul>
            <li>Access to gym equipment</li>
            <li>Use of locker room facilities</li>
          </ul>
        </div>
        <div class="price">P 300</div>
        <button onclick="window.location.href='payment.php'">Join now!</button>
      </div>

      <div class="plan">
        <h3>10 Sessions<br>(good for 1 month)</h3>
        <div class="includes">
          <h4>Includes:</h4>
          <ul>
            <li>Access to gym equipment</li>
            <li>Use of locker rooms</li>
          </ul>
        </div>
        <div class="price">P 2,600</div>
        <button onclick="window.location.href='payment.php'">Join now!</button>

      </div>

      <div class="plan">
        <h3>Monthly</h3>
        <div class="includes">
          <h4>Includes:</h4>
          <ul>
            <li>Access to gym equipment</li>
            <li>Use of locker rooms</li>
          </ul>
        </div>
        <div class="price">P 3,200</div>
        <button onclick="window.location.href='payment.php'">Join now!</button>
      </div>
    </div>
  </div>

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