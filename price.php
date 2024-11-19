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
      <a href="price.php" class="category active">GYM</a>
      <a href="boxing.php" class="category">Boxing</a>
      <a href="muay-thai.php" class="category">Muay Thai</a>
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
        <div class="price">P 100</div>
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
        <div class="price">P 1,000</div>
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
  width: 90%; /* Make the table wider */
  max-width: 1200px; /* Limit the maximum width */
  margin: 50px auto;
  background-color: #333;
  padding: 30px; /* Increase padding */
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
}

.pricing-table h2 {
  text-align: center;
  color: white;
  margin-bottom: 30px; /* Increase margin */
  font-size: 2em; /* Make the heading bigger */
}

.categories {
  display: flex;
  justify-content: center;
  margin-bottom: 40px; /* Increase margin */
  flex-wrap: wrap; /* Allow categories to wrap */
}

.category {
  padding: 12px 24px; /* Increase padding */
  background-color: #444;
  color: white;
  border-radius: 5px;
  margin: 10px;
  cursor: pointer;
  text-decoration: none; /* Remove underline from links */
  font-size: 1.2em; /* Make the category text bigger */
  white-space: nowrap; /* Prevent categories from breaking */
}

.category.active {
  background-color: #666;
}

.plans {
  display: flex;
  justify-content: center;
  flex-wrap: wrap; /* Allow plans to wrap */
}

.plan {
  width: 350px;
  background-color: white;
  color: #333;
  padding: 30px;
  border-radius: 10px;
  margin: 0 15px;
  height: 350px; /* Added height to make the plans longer */
  display: flex;
  flex-direction: column; /* Arrange items vertically */
  justify-content: space-between; /* Distribute space between items */
}

.plan h3 {
  text-align: center;
  margin-bottom: 20px;
  font-size: 2em; /* Increased font size */
}

.plan ul {
  list-style: disc;
  padding-left: 40px;
  margin-bottom: 30px;
  word-wrap: break-word;
  font-size: 1.2em; /* Increased font size */
}

.plan .price {
  text-align: center;
  font-size: 36px; /* Increased font size */
  margin-bottom: 30px;
  font-weight: bold; /* Made the price bold */
}

.plan button {
  background-color: #007bff;
  color: white;
  padding: 12px 24px; /* Increase padding */
  border: none;
  border-radius: 5px;
  cursor: pointer;
  display: block;
  width: 100%;
  font-size: 1.2em; /* Make the button text bigger */
}
</style>