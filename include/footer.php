<!DOCTYPE html>
<html>
<head>
  <style>
    footer {
      background-color: #333;
      color: #fff;
      padding: 20px;
      position: relative;
    }

    .footer-content {
      display: flex;
      justify-content: space-between;
    }

    .footer-logo {
      width: 200px;
      height: auto;
      margin-right: 20px;
    }

    .footer-text {
      margin: 0;
    }

    .copyright-info {
      text-align: center;
      margin-top: 20px;
    }

    .map-container {
      height: 300px;
      width: 400px;
    }

    .footer-column {
      width: 33.33%;
      text-align: center;
    }

    .footer-column:nth-child(2) {
      text-align: center;
    }

    .footer-column:nth-child(3) {
      text-align: left;
    }
  </style>
</head>
<body>
  <footer>
    <div class="footer-content">
      <div class="footer-column">
        <img class="footer-logo" src="./img/logo.png" alt="Your Company logo">
        <p style="text-align:left"> Join other restaurants who benefit from being partnered with Dapur UitM </p>
        <p style="text-align:left"> <a href="../partner.php"> Partner with Us</a></p>
      </div>
      <div class="footer-column">
        <div class="map-container">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3969.694735681377!2d102.27092387397033!3d5.757002931597851!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1sen!2smy!4v1706858359894!5m2!1sen!2smy" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
      <div class="footer-column">
      <p>Dapur UiTM Kelantan (Machang)</p>
        <p>UiTM Kelantan, Kampung Belukar, 18500 Machang, Kelantan</p>
        <p>Your Contact Info</p>
        <p>Email: 2022912639@student.uitm.edu.my</p>
        <p>Contact us: <a href="contactus.php">Contact Us</a></p>
        <p>About Us: <a href="./aboutus.php">About Us</a></p>
      </div>
    </div>
    <div class="copyright-info">
      <p>&copy; <?php echo date("Y"); ?> Dapur UiTM Kelantan Machang. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>