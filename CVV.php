<!DOCTYPE html>
<html>
<head>
  <title>CVV Help</title>
</head>
  <body>

  <div class="cvv-help-container">
    <h3>Your card's security code (CVV) is the 3 or 4 digit number located on the front or back of most cards.</h3>

    <div class="card-examples">
      <div class="card-example">
        <img src="images/cvv-help1.png" alt="Card Example 1">
      </div>
      <div class="card-example">
        <img src="images/cvv-help2.png" alt="Card Example 2">
      </div>
    </div>

    <button class="close-button" onclick="window.close()">&times;</button>
  </div>
  </body>
  </html>

  <style>
    body {
      font-family: sans-serif;
      background-color: #333; /* Dark background */
      color: white;
    }

    .cvv-help-container {
      width: 800px;
      margin: 50px auto;
      background-color: #444; /* Slightly lighter background */
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
      text-align: center;
      position: relative; /* To position the close button */
    }

    .cvv-help-container h3 {
      margin-bottom: 20px;
    }

    .cvv-help-container p {
      line-height: 1.6;
      margin-bottom: 30px;
    }

    .card-examples {
      display: flex;
      justify-content: center;
      gap: 20px;
    }

    .card-example {
      background-color: #eee;
      padding: 20px;
      border-radius: 5px;
      width: 300px;
      text-align: left;
    }

    .card-example img {
      width: 100%;
      height: auto;
    }

    .close-button {
      position: absolute;
      top: 10px;
      right: 10px;
      background-color: transparent;
      border: none;
      font-size: 20px;
      cursor: pointer; 
      font-size: 30px; 
      color: white;
    }
  </style>