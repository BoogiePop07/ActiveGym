<!DOCTYPE html>
<html>
<head>
  <title>Set up your credit or debit card</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <body>

  <div class="card-setup-container">
    <i class="fas fa-lock lock-icon"></i> <div class="payment-box">
      <h3>Set up your credit or debit card</h3>

      <div class="card-logos">
        <img src="images/visa.svg" alt="Visa">
        <img src="images/Mastercard-logo.svg" alt="Mastercard">
      </div>

      <div class="form-group">
        <label for="card-number">Card Number</label>
        <input type="text" id="card-number" name="card-number" placeholder="Enter your card number">
      </div>

      <div class="form-group">
        <label for="expiration-date">Expiration Date</label>
        <input type="text" id="expiration-date" name="expiration-date" placeholder="MM/YY"> 

      </div>

      <div class="form-group">
  <label for="cvv">CVV</label>
  <div class="cvv-container"> <input type="text" id="cvv" name="cvv" placeholder="Enter CVV">
    <a href="CVV.php" class="cvv-help" target="_blank">?</a>
  </div>
</div>

      <div class="form-group">
        <label for="cardholder-name">Name on Card</label>
        <input type="text" id="cardholder-name" name="cardholder-name" placeholder="Enter cardholder name">
      </div>

      <p>Your payments will be processed internationally. Additional bank fees may apply.</p>

      <div class="terms-checkbox">
        <input type="checkbox" id="agree" name="agree">
        <label for="agree">By checking the checkbox below, you agree to our Terms of Use, Privacy Statement, and that you are over 18. ActiveGym will automatically continue your membership and charge the membership fee to your payment method until you cancel. You may cancel at any time to avoid future charges.</label>   

      </div>

      <button class="start-membership">START MEMBERSHIP</button>
    </div>
  </div>


</head>
</body>
</html>

<style> 

    body {
      font-family: sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: #f0f0f0;
    }

    .card-setup-container 
 {
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      text-align: center;
      max-width: 500px;
    }

    .card-setup-container h3 {
      margin-bottom: 20px;
    }

    .card-logos {
      display: flex;
      justify-content: center;
      margin-bottom: 20px;
    }

    .card-logos img {
      height: 30px;
      margin: 0 5px;
    }

    .form-group {
      margin-bottom: 15px;
      text-align: left;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
    }

    .form-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid#ccc;
      border-radius: 5px;
      box-sizing: border-box; 

    }

    .cvv-help {
        display: inline-block;
      margin-left: 5px;
      cursor: pointer;
      color: #007bff; /* Blue color */
      text-decoration: none; /* Remove underline */
    }

    .cvv-container {
        position: relative; /* To position the question mark inside */
    }

    .cvv-container input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    }

    .cvv-container .cvv-help {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    display: inline-block;
    cursor: pointer;
    color: #007bff;
    text-decoration: none;
    }

    .terms-checkbox {
      display: flex;
      align-items: center;
      margin-top: 20px;
      text-align: left;
    }

    .terms-checkbox input {
      margin-right: 10px;
    }

    .start-membership {
      background-color: #28a745;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 20px;
      font-size: 16px;
    }

    /* Added styles for the lock icon */
    .lock-icon {
      font-size: 36px;
      margin-bottom: 20px;
      color: #007bff; /* Blue color */
    }
  </style>