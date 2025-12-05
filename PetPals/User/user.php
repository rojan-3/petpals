<?php
require '../Dashboard/configer/dbcon.php';
include('../Login/functions/userMyfunctions.php'); 
if(!isset($_SESSION['auth']))
{
  header('Location: ../Login/login.php');
  exit();
}
else
{
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PetPals</title>
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css? family=kaushan+script|popping&display=swap" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="user.css">
</head>
<body>
<div class="navbar">
      <a href="../Home/Index.php"><img src="./Images/logo2.png" class="logo"></a>
      <ul>
        <li><a  href="../Home/Index.php">HOME</a></li>
        <li><a href="../Blog/Blog.php">BLOG</a></li>
        <li><a href="../Products/product.php">PRODUCTS</a></li>
        <li><a href="../Contact/Contact.php">CONTACT</a></li>
        <li><a class="active" onclick="toggleMenu()"><i class="fa fa-user"></i></a>&nbsp;</li>
      </ul>
          <div class="sub-menu-wrap" id="subMenu">
           <?php
          if(isset($_SESSION['auth']))
          {
           
          ?>
            <div class="sub-menu">
              <div class="user-info">
                <!-- <img src="./Images/logo.png" alt="Image"> -->
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
              <a href="#" class="sub-menu-link">
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
      <div class="container">
        <div class="checkoutLayout">
           


            <div class="right">
                <h3>Manage Your Profile</h3>
                <?php
            require '../Dashboard/configer/dbcon.php';
            $product = "Select * from users where id =".$_SESSION['id'];
            $result = mysqli_query($con, $product);
             $row = mysqli_fetch_assoc($result);
             ?>
                <form action="../Login/functions/authcode.php" method="POST">
                    <div class="group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" id="name" value="<?php echo $row['name']; ?>" required>
                    </div>
                    <div class="group">
                        <label for="email">Email</label>
                        <input type="email" id="email"  value="<?php echo $row['email']; ?>" disabled>
                    </div>
                    <div class="group">
                        <label for="address">Address</label>
                        <input type="text" name="address" value="<?php echo $row['address']; ?>" id="address"required>
                    </div>
                    <div class="sahii">
                        <div class="group">
                            <label for="phone">Phone</label>
                            <input type="number" value="<?php echo $row['phone']; ?>" name="phone" id="phone" required>
                        </div>

                        <div class="group">
                            <label for="city">City</label>
                            <input type="text" name="city" value="<?php echo $row['city']; ?>" id="city" required>
                        </div>
                    </div>
                    <?php if(isset($_SESSION['message']))
                    { 
                    ?>
                    <?= $_SESSION['message'];?>
                    <?php
                    unset($_SESSION['message']);
                    } 
                    ?>
                    <div class="return">
                        </div>
                        <button type="submit" class="buttonCheckout" name="updateUserBtn">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>


   
    <script>
    let subMenu = document.getElementById("subMenu");

    function toggleMenu()
    {
      console.log("Function called");
      subMenu.classList.toggle("open-menu");
    }
  </script>
<?php 
}
?>
</body>
</html>