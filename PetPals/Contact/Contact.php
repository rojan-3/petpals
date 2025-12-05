<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PetPals</title>
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css? family=kaushan+script|popping&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="./Contact.css">
</head>

<body>
  <div class="navbar">
    <a href="../Home/Index.php"><img src="./Images/logo.png" class="logo"></a>
    <ul>
      <li><a href="../Home/Index.php">HOME</a></li>
      <li><a href="../Blog/Blog.php">BLOG</a></li>
      <li><a href="../Products/product.php">PRODUCTS</a></li>
      <li><a class="active" href="../Contact/Contact.php">CONTACT</a></li>
      <li><a onclick="toggleMenu()"><i class="fa fa-user"></i></a>&nbsp;</li>
    </ul>
    <!-- <img src="Images/profile.png" class="user-pic" onclick="toggleMenu()"> -->
    <div class="sub-menu-wrap" id="subMenu">
      <?php
      if (isset($_SESSION['auth'])) {
        ?>
        <div class="sub-menu">
          <div class="user-info">
            <!-- <img src="./Images/Novelty.png" alt="Image"> -->
            <h4>
              <?= $_SESSION['name']; ?>
            </h4>
          </div>
          <?php
      } else {
        ?>
          <div class="sub-menu">
            <div class="user-info">
              <!-- <img src="./Images/Novelty.png" alt="Image"> -->
              <h3>Hello Guest</h3>
            </div>
            <?php
      }
      ?>
          <hr>
          <a href="../User/user.php" class="sub-menu-link">
            <img src="./Images/profile.png">
            <p>Manage Profile</p>
            <span><i class="bx bx-chevron-right data"></i></span>
          </a>
          <a href="../Cart/Cart.php" class="sub-menu-link">
            <img src="./Images/cart.png">
            <p>Cart</p>
            <span><i class="bx bx-chevron-right data"></i></span>
          </a>
          <a href="../Cart/my-orders.php" class="sub-menu-link">
            <img src="./Images/order3.png">
            <p>Track my Order</p>
            <span><i class="bx bx-chevron-right data"></i></span>
          </a>
          <?php
          if (isset($_SESSION['auth'])) {
            ?>
            <a href="../Login/logout.php" class="sub-menu-link">
              <img src="Images/logout.png">
              <p>Logout</p>
              <span><i class="bx bx-chevron-right data"></i></span>
            </a>
            <?php
          } else {
            ?>
            <a href="../Login/login.php" class="sub-menu-link">
              <img src="Images/login.png">
              <p>Login</p>
              <span><i class="bx bx-chevron-right data"></i></span>
            </a>
            <?php
          }
          ?>

        </div>
      </div>

    </div>

    <!-- Heading -->
    <!-- <section id="page-header">

      <h2>#KnowUs</h2>
      <p>Visit us now, We'll love to have you.</p>

    </section> -->


    <section id="contact-details" class="section-p1 section-m1">
      <div class="details">
        <span>GET IN TOUCH</span>
        <h2>Visit one of our agency locations or contact us today.</h2>
        <h3>Head Office</h3>
        <div>
          <li>
            <i class="fa fa-map"></i>
            <p>Soltemod, Kalimati, Kathmandu</p>
          </li>
          <li>
            <i class="fa fa-envelope"></i>
            <p>petpals@gmail.com</p>
          </li>
          <li>
            <i class="fa fa-phone"></i>
            <p>9860118926, 9800000000</p>
          </li>
          <li>
            <i class="fa fa-clock-o"></i>
            <p>Sunday to Friday: 9:00 AM to 8:00 PM</p>
          </li>
        </div>
      </div>
      <div class="map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.665383705108!2d85.2926532742854!3d27.69673517618857!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb185db3d16e61%3A0x48c2b3fdca032fa6!2sKathmandu%20College%20of%20Central%20State!5e0!3m2!1sen!2snp!4v1700983699826!5m2!1sen!2snp" 
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </section>



    <!----------------- Newsletter --------------------->
    <section id="newsletter" class="section-p1 section-m1">
      <div class="nestext">
        <h4>Sign up for Newsletter</h4>
        <p>Get E-mail updates about our latest shop and <span class="span2">special offers</span>.</p>
      </div>
      <form class="form" action="../Login/functions/newsLetter.php" method="POST">
        <input type="email" name="email" placeholder="Your Email Address">
        <button type="submit" name="news_btn" class="normal">Subscribe</button>
      </form>
    </section>


    <!--------------------Footer ------------------>
    <footer class="section-p1">
    <div class="col">
      <img src="./Images/logo.png" class="logo1" alt="img">
      <h4>Contact</h4>
      <p><strong>Address:</strong> Soltemod, Kalimati, Kathmandu </p>
      <p><strong>Phone:</strong> 9860118926/ 9810000000 </p>
      <p><strong>Hours:</strong> 10:00 - 18:00, Sun - Fri </p>
      <div class="follow">
        <h4>Follow us</h4>
        <div class="icon">
          <a href="https://www.facebook.com/profile.php?id=100090264392956"><i class="fa fa-facebook-f"></i></a>
          <a href="#"><i class="fa fa-twitter"></i></a>
          <a href="https://www.instagram.com/matri_digital/"><i class="fa fa-instagram"></i></a>
          <a href="#"><i class="fa fa-youtube"></i></a>
        </div>
      </div>
    </div>

    <div class="col">
      <h4>About</h4>
      <a href="../About/about_us.php">About us</a>
      <a href="../Cart/checkout.php">Delivery Information</a>
      <a href="../Privacy/Privacy.php">Privacy policy</a>
      <!-- <a href="#">Terms & Conditions</a> -->
      <a href="../Contact/Contact.php">Contact us</a>
    </div>

    <div class="col">
      <h4>My Account</h4>
      <?php
      if (isset($_SESSION['auth'])) {
      ?>
        <a href="../Login/logout.php">Sign out</a>
      <?php
      } else {
      ?>
        <a href="../Login/login.php">Sign in</a>
      <?php
      }
      ?>
      <a href="..\Cart\Cart.php">View cart</a>
      <!-- <a href="#">My Wishlist</a> -->
      <a href="../Cart/my-orders.php">Track my order</a>
      <a href="../Help/Help.php">Help</a>
    </div>

    <!-- <div class="col install">
      <h4>Comming Soon</h4>
      <p>Install from App Store or Google Play</p>
      <div class="row">
        <a href="#"><img src="./Images/app.jpg" alt=""></a>
        <a href="#"><img src="./Images/play.jpg" alt=""></a>
      </div>
      <p>Secured Payment Gateway</p>
      <a href="#"><img src="./Images/pay.png" alt=""></a>
    </div> -->

    <div class="copyright">
      <p>2025, PetPals Pvt. Ltd.</p>
    </div>
  </footer>

<script>
    let subMenu = document.getElementById("subMenu");

    function toggleMenu()
    {
      console.log("Function called");
      subMenu.classList.toggle("open-menu");
    }
  </script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <script src="../Book/sbook.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
</body>
</html>