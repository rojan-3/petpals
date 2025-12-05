<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="about_us.css">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css? family=kaushan+script|popping&display=swap" rel="stylesheet" />
    <title>PetPals</title>
</head>
<body>
<div class="navbar">
      
      <a href="../Home/Index.php"><img src="./Images/logo.png" class="logo"></a>
      <ul>
        <li><a class="active" href="../Home/Index.php">HOME</a></li>
        <li><a href="../Blog/Blog.php">BLOG</a></li>
        <li><a href="../Products/product.php">PRODUCTS</a></li>
        <li><a href="../Contact/Contact.php">CONTACT</a></li>
        <li><a onclick="toggleMenu()"><i class="fa fa-user"></i></a>&nbsp;</li>
      </ul>
      <!-- <img src="Images/profile.png" class="user-pic" onclick="toggleMenu()"> -->
          <div class="sub-menu-wrap" id="subMenu">
          <?php
          if(isset($_SESSION['auth']))
          {          
          ?>
            <div class="sub-menu">
              <div class="user-info">
                <!-- <img src="./Images/Novelty.png" alt="Image"> -->
                <h4><?= $_SESSION['name']; ?></h4>
              </div>
              <?php
              }
              else
              {
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
                <img src="Images/profile.png">
                <p>Manage Profile</p>
                <span><i class="bx bx-chevron-right data"></i></span>
              </a>
              <a href="../Cart/Cart.php" class="sub-menu-link">
                <img src="Images/cart.png">
                <p>Cart</p>
                <span><i class="bx bx-chevron-right data"></i></span>
              </a>
              <a href="../Cart/my-orders.php" class="sub-menu-link">
                <img src="Images/order3.png">
                <p>Track my Order</p>
                <span><i class="bx bx-chevron-right data"></i></span>
              </a>
              <?php 
                if(isset($_SESSION['auth']))
                {
                  ?>
                  <a href="../Login/logout.php" class="sub-menu-link">
                  <img src="Images/logout.png">
                  <p>Logout</p>
                  <span><i class="bx bx-chevron-right data"></i></span>
                  </a>
                  <?php
                }
                else
                {
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

    <div class="wrapper">

<div class="background-container">
    <div class="bg-1"></div>
    <div class="bg-2"></div>

</div>
<div class="about-container">
    
    <div class="image-container">
        <img src="./Images/ab2.png" alt="img">
        
    </div>

    <div class="text-container">
        <h2>About PetPals</h2>
        <p class="justified-text">
        Welcome to PetPals, your trusted partner in pet care! At PetPals,
         we believe that pets are more than just animals—they're family. 
         Our mission is to provide high-quality services, products, and expert
          advice to help you take the best care of your furry, feathered, or
           scaly companions. Founded with a passion for pets and a deep love for
            animals, PetPals began as a small local store with a big vision: to create 
            a space where pet owners could find everything they need to nurture and spoil
             their pets. Despite our growth, our heart remains the same—to treat every pet as if they were our own.
        </p>
        <!-- <a href="">Read More</a> -->
    </div>
    
</div>
</div>
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
 <!----------------------------- Footer ------------------------------------->
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
    <script>
    let subMenu = document.getElementById("subMenu");

    function toggleMenu()
    {
      console.log("Function called");
      subMenu.classList.toggle("open-menu");
    }
  </script>
</footer>
</body>
</html>