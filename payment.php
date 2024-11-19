<!DOCTYPE html>
<html>
<head>
  <title>Choose how to pay</title>
  <link rel="stylesheet" href="payment.css">
</head>
<body>



  <div class="payment-container">
    <img src="images/payment-methods.svg" alt="Your Logo" class="logo"> <div class="payment-box">
      <i class="fas fa-lock"></i>
      <h3>Choose how to pay</h3>
      <p>Your payment is encrypted and you can change how you pay anytime.</p>
      <p class="secure">Secure for peace of mind.</p>

      <div class="payment-options">
        <button class="card-option" onclick="window.location.href='card-payment.php'">
          Credit or Debit Card
          <img src="images/visa.svg" alt="Visa">
          <img src="images/Mastercard-logo.svg" alt="Mastercard">
        </button>
        <button class="wallet-option" onclick="window.location.href='digital-payment.php'">
          Digital Wallet
          <img src="images/gcash.png" alt="GCash">
        </button>
      </div>
    </div>
  </div>

</body>
</html>

<style>
body {
      font-family:sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: #f0f0f0;
    }

    .payment-container {
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .payment-box {
      max-width: 400px;
      margin: 0 auto;
    }

    .payment-box i {
      font-size: 36px;
      margin-bottom: 20px;
      color: #007bff; /* Blue color */
    }

    .payment-box h3 {
      margin-bottom: 10px;
    }

    .payment-box p {
      line-height: 1.6;
    }

    .payment-box .secure {
      font-weight: bold;
      margin-top: 20px;
    }

    .payment-options button {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
      padding: 15px;
      margin-bottom: 10px;
      background-color: #eee;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }

    .payment-options button img {
      height: 20px;
    }

    /* Added styles for the logo */
    .logo {
      display: block;
      margin: 0 auto 20px auto; /* Center the logo */
      width: 100px; /* Adjust the width as needed */
    }
</style>