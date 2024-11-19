<!DOCTYPE html>
<html>
<head>
  <title>Set up GCash</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

  <div class="gcash-setup-container">
    <i class="fas fa-lock lock-icon"></i>
    <div class="payment-box">
      <h3>Set up GCASH</h3>

      <div class="form-group">
        <label for="mobile-number">
          <img src="philippines-flag.png" alt="Philippines Flag" class="flag-icon"> +63 Mobile Number
        </label>
        <input type="text" id="mobile-number" name="mobile-number" placeholder="Enter your GCash mobile number">
      </div>

      <p>Your payments will be processed through GCash. Ensure that your GCash account is active and has sufficient balance.</p>

      <div class="terms-checkbox">
        <input type="checkbox" id="agree" name="agree">
        <label for="agree">By checking the checkbox below, you agree to our Terms of Use, Privacy Statement, and that you are over 18. ActiveGym will automatically continue your membership and charge the membership fee to your payment method until you cancel. You may cancel at any time to avoid future charges.</label>   

      </div>

      <button class="start-membership">START MEMBERSHIP</button>
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

    .gcash-setup-container {
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      text-align: center;
      max-width: 500px;
    }

    .gcash-setup-container h3 {
      margin-bottom: 20px;
    }

    .gcash-logo {
      display: block;
      margin: 0 auto 20px auto;
      width: 100px;
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
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box; 

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

    /* Styles for the flag icon */
    .flag-icon {
      margin-right: 5px;
    }
  </style>