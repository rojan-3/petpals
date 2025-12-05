<?php
session_start();
require '../Dashboard/configer/dbcon.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive Services Section</title>
    <!-- Font Awesome CDN-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <!-- Google Font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap"
      rel="stylesheet"
    />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="Help.css" />
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
    <section>
      <div class="row">
        <h2 class="section-heading">For Help</h2>
      </div>
      <div class="row">
        <div class="column">
          <div class="card">
            <div class="icon-wrapper">
              <i class="fas fa-hammer"></i>
            </div>
            <h3>Service Heading</h3>
            <p>
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam
              consequatur necessitatibus eaque.
            </p>
          </div>
        </div>
        <div class="column">
          <div class="card">
            <div class="icon-wrapper">
              <i class="fas fa-brush"></i>
            </div>
            <h3>Service Heading</h3>
            <p>
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam
              consequatur necessitatibus eaque.
            </p>
          </div>
        </div>
        <div class="column">
          <div class="card">
            <div class="icon-wrapper">
              <i class="fas fa-wrench"></i>
            </div>
            <h3>Service Heading</h3>
            <p>
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam
              consequatur necessitatibus eaque.
            </p>
          </div>
        </div>
        
      </div>
    </section>
    
<script>
    let subMenu = document.getElementById("subMenu");

    function toggleMenu()
    {
      console.log("Function called");
      subMenu.classList.toggle("open-menu");
    }
  </script>
  </body>
</html>