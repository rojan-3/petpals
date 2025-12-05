<?php
include('../Login/functions/userMyfunctions.php');
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
  <link rel="stylesheet" href="./Product.css">
</head>

<body>
  <div class="navbar">
    <a href="../Home/Index.php"><img src="./Images/logo.png" class="logo"></a>
    <!-- <div>
      <div class="box">
        <input type="text" name="query" id="live_search" placeholder="Search..">
        <button  type="submit"><i class="fa fa-search"></i></button>
      </div>
      <div id="searchresult"></div>
      </div> -->
      
      <!-- Search -->
    <div class="search-bar">
      <form action="search.php" method="GET" class="search-container">
        <input type="text" name="query" placeholder="Search..." required>
        <button type="submit">
          Search
        </button>
      </form>
    </div>
    
      <!-- Search -->
    
    <ul>
      <li><a href="../Home/Index.php">HOME</a></li>
      <li><a href="../Blog/Blog.php">BLOG</a></li>
      <li><a class="active" href="../Products/Product.php">PRODUCTS</a></li>
      <li><a href="../Contact/Contact.php">CONTACT</a></li>
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
            <h4><?= $_SESSION['name']; ?></h4>
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
    <section id="page-header">

      <h2>#PawsomeProducts</h2>
      <p>From tail-wagging treats to purr-fect essentials, we’ve got everything your pets need to thrive! </p>

    </section>
    <section>


    </section>
    <!-- Categories -->
    <div class="select-menu">

      <div class="select-btn">
        <span class="sBtn-text">Categories</span>
        <i class="bx bx-chevron-down"></i>
      </div>
      <ul class="options">

        <?php
        $categories = getAllActive("categories");

        if (mysqli_num_rows($categories) > 0) {
          foreach ($categories as $item) {
            ?>
            <a href="./products.php?category=<?= $item['slug']; ?>">
              <li class="option">
                <!-- <i class="bx bx-book"></i> -->
                <span class="option-text  active"><?= $item['name']; ?></span>
              </li>
            </a>
            <?php
          }
        } else {
          echo "No Data Available!!";
        }
        ?>
      </ul>
    </div>

    <!-- All Product -->
    <section id="product1" class="section-p1">
      <div class="pro-container">
        <?php
        $query = "SELECT * FROM products WHERE status='0'";
        $query_run = mysqli_query($con, $query);
        $check_products = mysqli_num_rows($query_run) > 0;

        if ($check_products) {
          while ($row = mysqli_fetch_array($query_run)) {
            ?>
            <a href="./sproduct.php?product=<?= $row['slug']; ?>">
              <div class="pro">

                <img src="../Dashboard/main/uploads/<?= $row['image']; ?>" alt="All Images">
                <br>
                <div class="des">
                  <span><?php echo $row['name']; ?></span>
                  <h5><?php echo $row['brand']; ?></h5>
                  <div class="star">
                    <i class="fa fa-paw"></i>
                    <i class="fa fa-paw"></i>
                    <i class="fa fa-paw"></i>
                    <i class="fa fa-paw"></i>
                    <i class="fa fa-paw"></i>


                  </div>
                  <h4>Rs.<?php echo $row['selling_price']; ?></h4>
                </div>
            </a>
            <!-- <button class="addToCartBtn" value="<?= $row['id']; ?>"><i class="fa fa-shopping-cart"></i></button> -->
            <?php if ($row['qty'] > 0) { ?>
              <button class="addToCartBtn" value="<?= $row['id']; ?>"><i class="fa fa-shopping-cart"></i></button>
            <?php } else { ?>
              <span class="out-of-stock">Out of Stock</span>
            <?php } ?>
          </div>

          <?php

          }
        } else {
          echo "No Products Found";
        }
        ?>
  </div>
  </section>


  <!-- Pagination -->
  <!-- <section id="pagination" class="section-p1">
          <a href="#">1</a>
          <a href="#">2</a>
          <a href="#">--<i class="fa fa-arrow"></i></a>
        </section> -->

  <!-- Newsletter  -->
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
  </footer>

  <script>
    let subMenu = document.getElementById("subMenu");

    function toggleMenu() {
      console.log("Function called");
      subMenu.classList.toggle("open-menu");
    }
  </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="./script.js"></script>
  <script src="./Book.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script type="text/javascript">
    $(document).ready(function () {
      $("#live_search").keyup(function () {
        var input = $(this).val();
        //alert(input);
        if (input != "") {
          $.ajax({
            url: "./livesearch.php",
            method: "POST",
            data: { input: input },

            success: function (data) {
              $("#searchresult").html(data);
            }

          });
        }
        else {
          $("#searchresult").css("display", "none");
        }
      });
    });
  </script>

</body>

</html>