<?php
session_start();
if(isset($_SESSION['auth']))
{
  header('Location: ../Home/Index.php');
  exit();
}
?>
<html>
     <head>
        <title>PetPals</title>
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="login.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css? family=kaushan+script|popping&display=swap" rel="stylesheet"/>
        <!-- <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet"/> -->
       
       
     </head>

   <body>

      <div id="banner" class="background" >

        <div class="navbar">
        <a href="../Home/Index.php"><img src="./Images/logo2.png" class="logo"></a>
        <ul>
        <li><a  href="../Home/Index.php">HOME</a></li>
        <li><a href="../Blog/Blog.php">BLOG</a></li>
        <li><a href="../Products/product.php">PRODUCTS</a></li>
        <li><a href="../Contact/Contact.php">CONTACT</a></li>
        <li><a class="active" onclick="toggleMenu()"><i class="fa fa-user"></i></a>&nbsp;</li>
        </ul>
        <!-- <img src="Images/profile.png" class="user-pic" onclick="toggleMenu()"> -->
          <div class="sub-menu-wrap" id="subMenu">
            <div class="sub-menu">
              <div class="user-info">
                <!-- <img src="./Images/Novelty.png" alt="Image"> -->
                <h3>Hello Guest</h3>
              </div>
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

           <div class="card-body">
             <form action="functions/authcode.php" method="POST">
               <h2>Sign In</h2>
                 <div class="form-group">
                <label for="username">Email</label>
                <input type="text" id="username" name="email" required>
                 </div>
                 <div class="form-group">
                   <label for="password">Password</label>
                   <input type="password" id="password" name="password" required>
                 </div>
                 
                 <?php if(isset($_SESSION['message'])){ ?>
                  <p class="alert"></p> <?= $_SESSION['message']; ?>
                  <?php
                  unset($_SESSION['message']);
                  } ?>
                 <div class="form-group">
                 <button type="submit" name="log_btn" class="btn">Login</button>
              </form>
              <p class="switch-text">Don't have an account? <a href="../Login/register.php">Sign up</a></p>
              
           </div>


          <script>
            let subMenu = document.getElementById("subMenu");
            function toggleMenu()
            {
              subMenu.classList.toggle("open-menu");
            }
          </script>
</body>
</html>