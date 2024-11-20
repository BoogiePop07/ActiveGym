<!DOCTYPE html>
<html>
<head>
  <title>Notifications</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> 
</head>
<body>

  <div class="notifications-container" id="notifications-container">
    <div class="header-bar">
      <img src="images/MTFC_LOGO.PNG" alt="Logo" class="logo">
      <button class="close-button" onclick="closeNotifications()">X</button>
    </div>
    <h2>Notifications</h2>

    <div class="notification-list" id="notification-list">

      <div class="notification" id="notif1">
        <div class="notification-header">
          <img src="gym-class-icon.png" alt="Gym Class Icon">
          <h3>Gym Class Announcement</h3>
          <span class="date">10/12/2024</span>
        </div>
        <div class="notification-content">
          <p>Attention All Gym Members!</p>
          <p>We are excited to announce new gym classes starting this week! Whether you're a beginner or a seasoned athlete, we've got something for everyone.</p>
        </div>
      </div>

      <div class="notification" id="notif2">
        <div class="notification-header">
          <img src="comment-icon.png" alt="Comment Icon">
          <h3>Kurt Carreon commented on your post.</h3>
          <span class="date">10/07/2024</span>
        </div>
      </div>

      <div class="notification" id="notif3">
        <div class="notification-header">
          <img src="reaction-icon.png" alt="Reaction Icon">
          <h3>Mark Matthew reacted to your post.</h3>
          <span class="date">10/06/2024</span>
        </div>
      </div>

      <div class="notification" id="notif4">
        <div class="notification-header">
          <img src="billing-icon.png" alt="Billing Icon">
          <h3>Billing Reminder - Gym Membership</h3>
          <span class="date">09/26/2024</span>
        </div>
        <div class="notification-content">
          <p class="highlight">Important Notice</p>
          <p>Dear Member,</p>
          <p>This is a friendly reminder that your gym membership payment is due soon. To avoid any interruption in your access, please make sure to settle your billing on or before the due date.</p>
          <p class="due-date">Due Date: October 31, 2024</p>
        </div>
      </div>

      <div class="notification" id="notif5">
        <div class="notification-header">
          <img src="follow-icon.png" alt="Follow Icon">
          <h3>Bea Nicole started following you.</h3>
          <span class="date">09/24/2024</span>
        </div>
      </div>

    </div>
  </div>

  <script>
    // JavaScript to close the notifications container
    function closeNotifications() {
      const notifications = document.getElementById('notifications-container');
      notifications.style.display = 'none'; // Hide the notifications container
    }

    // Add hover effect to notifications using JavaScript
    const notifications = document.querySelectorAll('.notification');

    notifications.forEach(notification => {
      notification.addEventListener('mouseenter', () => {
        notification.style.backgroundColor = '#555'; // Change background color on hover
      });

      notification.addEventListener('mouseleave', () => {
        notification.style.backgroundColor = '#444'; // Revert background color when not hovering
      });
    });
  </script>

</body>
</html>

<style>
  body {
    font-family: sans-serif;
    background-color: #222;
    color: white;
    margin: 0;
  }

  .notifications-container {
    width: 100%;
    margin: 0;
    background-color: #333;
    padding: 20px;
    box-sizing: border-box;
    position: relative; /* For positioning the header bar */
  }

  .header-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    position: relative;
  }

  .logo {
    width: 100px;
    height: 60px;
    object-fit: contain;
    background-color: white;
    padding: 5px;
    border-radius: 5px;
  }

  .close-button {
    background-color: #ff4d4d;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 5px 10px;
    font-size: 1em;
    cursor: pointer;
  }

  .close-button:hover {
    background-color: #e63939;
  }

  .notifications-container h2 {
    text-align: center;
    margin-bottom: 20px;
  }

  .notification {
    background-color: #444;
    margin-bottom: 10px;
    padding: 15px;
    border-radius: 5px;
    display: flex;
    flex-direction: column;
    transition: background-color 0.3s ease;
  }

  .notification-header {
    display: flex;
    align-items: center;
    width: 100%;
  }

  .notification-header img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 10px;
  }

  .notification-header h3 {
    margin: 0;
    font-size: 1.2em;
    flex-grow: 1;
  }

  .notification-header .date {
    font-size: 0.9em;
    color: #999;
    white-space: nowrap;
    margin-left: auto;
  }

  .notification-content {
    margin-top: 10px;
  }

  .notification-content p {
    margin-bottom: 5px;
  }

  .notification-content .highlight {
    font-weight: bold;
    margin-bottom: 10px;
  }

  .notification-content .due-date {
    font-weight: bold;
  }
</style>