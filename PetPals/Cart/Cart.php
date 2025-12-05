<?php
include('../Login/functions/userMyfunctions.php');
include('../Dashboard/middleware/authenticate.php');
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
  <link rel="stylesheet" href="./Cart.css">
</head>

<body>
<div class="navbar">
      <a href="../Home/Index.php"><img src="./Images/logo.png" class="logo"></a>
      <ul>
        <li><a  href="../Home/Index.php">HOME</a></li>
        <li><a href="../Blog/Blog.php">BLOG</a></li>
        <li><a href="../Products/Product.php">PRODUCTS</a></li>
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

  <!-- Heading -->
  <section id="page-header">

    <h2>#Cart</h2>
    <!-- <p>Reading opens doors to infinite knowledge, sparks boundless imagination, and nurtures the soul.</p> -->

  </section>

  <!-- Cart -->
  <div id="myReload">
    <section id="cart" class="section-p1">

      <table width="100%">
        <thead>
          <tr>
            <td>S.N.</td>
            <td>Product</td>
            <td>Image</td>
            <td>Price</td>
            <td>Quantity</td>
            <td>Remove</td>
          </tr>
        </thead>
        <?php $items = getCartItems();
        $count = 1;
        $totalPrice = 0;
        if (mysqli_num_rows($items) > 0) {

          $count = 1;
          $totalPrice = 0;
          

          foreach ($items as $citem) {
        ?>
            <tbody class="product_data">
              <tr>
                <td><?= $count ?></td>
                <!-- ../Book/sproduct.php?product=<?= $citem['slug'] ?> -->
                <?php
                require '../Dashboard/configer/dbcon.php';
                $product = "SELECT * FROM products WHERE id =" . $citem['prod_id'];

                // $product = "Select * from products where id =".$citem['prod_id'];
                $result = mysqli_query($con, $product);
                // $availableQty = $result['qty'];

                $row = mysqli_fetch_assoc($result);
                $availableQty = $row['qty'];

                ?>
                <td><a href="../Products/sproduct.php?product=<?= $row['slug']; ?>"><?= $citem['name']?></a></td>
                <td><a href="../Products/sproduct.php?product=<?= $row['slug']; ?>"><img src="../Dashboard/main/uploads/<?= $citem['image'] ?>" alt="Image"></a></td>
                <td>Rs.<?= $citem['selling_price'] ?>
                  <input type="hidden" class="prodId" value="<?= $citem['prod_id'] ?>">
                </td>
                <td>
                  <div class="row1">
                    <button class="minus decrement-btn updateQty"><i class="bx bx-chevron-left"></i></button>
                    <input type="text" class="input-qty" value="<?= $citem['prod_qty'] ?>" disabled>
                    <button class="plus increment-btn updateQty"><i class="bx bx-chevron-right"></i></button>
                    <a type="text" class="addToCartBtn" data-qty="<?= $availableQty ?>" disabled>


                  </div>
                </td>
              
            <!-- <button class="addToCartBtn" data-qty="<?= $availableQty ?>" value="<?= $citem['prod_id'] ?>">Add to Cart</button> -->
       

                <td><button class="deleteItem" value="<?= $citem['cid'] ?>"><i class="fa fa-times-circle"></i></button></td>
              </tr>
            </tbody>

          <?php
            $count++;
            $totalPrice +=  $citem['selling_price'] * $citem['prod_qty'];
          }

          ?>
      </table>
    </section>

    <!-- <section id="cart-add" class="section-p1">
      <div id="coupon">
        <h3>Apply coupon</h3>
        <div>
          <input type="text" placeholder="Enter Your coupon">
          <button class="normal">Apply</button>
        </div>
      </div> -->

      <div id="subtotal">

        <h3>Cart Total</h3>

        <table>
          <tr>
            <td>Cart Subtotal</td>
            <td>Rs.<?= $totalPrice ?></td>
          </tr>
          <tr>
            <td>Shipping</td>
            <td>Free</td>
          </tr>
          <tr>
            <td><strong>Total</strong></td>
            <td><strong>Rs.<?= $totalPrice ?></strong></td>
          </tr>
        <?php
        } else {
        ?>
          <h4>Your cart is empty</h4>

        <?php
        }
        ?>
        </table>

        <?php
        $items = getCartItems();
        if (mysqli_num_rows($items) > 0) {
        ?>
          <a href="./checkout.php" class="normal "><button>Proceed to checkout</button></a>
        <?php
        } else {
        }
        ?>
      </div>
  </div>

  </section>
  </div>



  <!-- Newsletter -->
  <section id="newsletter" class="section-p1 section-m1">
    <div class="nestext">
      <h4>Sign up for Newsletter</h4>
      <p>Get E-mail updates about our latest shop and <span class="span2">special offers</span>.</p>
    </div>
    <form class="form" action="../Login/functions/newsLetter.php" method="POST">
      <input type="email" name="email" placeholder="Your Email Address">
      <button type="submit" name="news_btn" class="normal">Sign up</button>
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

    function toggleMenu()
    {
      console.log("Function called");
      subMenu.classList.toggle("open-menu");
    }
  </script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <script src="../Products/sbook.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




  
</body>
</html>