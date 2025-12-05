<?php
include('../Login/functions/userMyfunctions.php');
include('../Dashboard/middleware/authenticate.php');

if (isset($_POST['placeOrderBtn'])) 
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $payment_mode = mysqli_real_escape_string($con, $_POST['payment_mode']);
    $payment_id = mysqli_real_escape_string($con, $_POST['payment_id']);

    if ($name == "" || $email == "" || $phone == "" || $address == "" || $city == "") 
    {
        $_SESSION['message'] = "All Fields are Mandetory";
        header('Location: ./checkout.php');
        // exit(0);
    } 
    else 
    {
        if (!validateFullName($name) || !validateCity($city) || !validateAddress($address)) 
        {
            $_SESSION['message'] = "Please Enter Valid Information.";
            header('Location: ./checkout.php');
           
        } 
        else 
        {
            $userId = $_SESSION['auth_user']['user_id'];
            $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price, p.category_id
            FROM carts c, products p WHERE c.prod_id=p.id AND c.user_id='$userId' ORDER BY c.id DESC";
            $query_run = mysqli_query($con, $query);

            $totalPrice = 0;
            foreach ($query_run as $citem) 
            {
                $totalPrice +=  $citem['selling_price'] * $citem['prod_qty'];
            }
            $tracking_no = "aadi" . rand(1111, 9999) . substr($phone, 2);

            $insert_query = "INSERT INTO orders (tracking_no, user_id,	name, email, phone,	address, city, total_price,
            payment_mode, payment_id) VALUES ('$tracking_no', '$userId', '$name', '$email', '$phone', '$address',
            '$city', '$totalPrice', '$payment_mode', '$payment_id')";

            $insert_query_run = mysqli_query($con, $insert_query);

            if ($insert_query_run) {
                $order_id = mysqli_insert_id($con);
                foreach ($query_run as $citem) {
                    $prod_id = $citem['prod_id'];
                    $prod_qty = $citem['prod_qty'];
                    $price = $citem['selling_price'];
                    $category_id = $citem['category_id'];  // Fetch category_id

                    // Insert each item with category_id and user_id into order_items
                    $insert_items_query = "INSERT INTO order_items (order_id, prod_id, qty, price, category_id, user_id) 
                    VALUES ('$order_id', '$prod_id', '$prod_qty', '$price', '$category_id', '$userId')";
                    $insert_items_query_run = mysqli_query($con, $insert_items_query);

                    // Update product quantity
                    $product_query = "SELECT * FROM products WHERE id='$prod_id'";
                    $product_query_run = mysqli_query($con, $product_query);
                    $productData = mysqli_fetch_assoc($product_query_run);

                    $current_qty = $productData['qty'];
                    $new_qty = $current_qty - $prod_qty;
                    $updateQty_query = "UPDATE products SET qty='$new_qty' WHERE id='$prod_id'";
                    $updateQty_query_run = mysqli_query($con, $updateQty_query);
                }

                // Delete the cart items after order placement
                $deleteCartQuery = "DELETE FROM carts WHERE user_id = '$userId'";
                $deleteCartQuery_run = mysqli_query($con, $deleteCartQuery);

                $_SESSION['message'] = "Order placed successfully";
                header('Location: ./my-orders.php');
                die();
            }
        }
    }
}
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
    <link rel="stylesheet" href="./Checkout.css">
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
      <!-- <img src="Images/profile.png" class="user-pic" onclick="toggleMenu()"> -->
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
                <!-- <img src="./Images/logo.png" alt="Image"> -->
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


    <!-- Cart -->
    <div class="container">
        <div class="checkoutLayout">
            <div class="returnCart">
                <a href="../Cart/Cart.php"><i class="bx bx-chevron-left data"></i>Back to Carts</a>
                <h1>Cart Summary</h1>
                <div class="list">
                    <?php
                    $items = getCartItems();
                    $count = 1;
                    $totalPrice = 0;
                    foreach ($items as $citem) {
                    ?>
                    <?php
                require '../Dashboard/configer/dbcon.php';
                $product = "Select * from products where id =".$citem['prod_id'];
                $result = mysqli_query($con, $product);
                $row = mysqli_fetch_assoc($result);
                ?>
                        <a href="../Products/sproduct.php?product=<?= $row['slug'] ?>">
                            <div class="item">
                                <img src="../Dashboard/main/uploads/<?= $citem['image'] ?>">
                                <div class="info">
                                    <div class="name"><?= $citem['name'] ?></div>
                                    <div class="price"></div>
                                </div>
                                <div class="quantity">x<?= $citem['prod_qty'] ?></div>
                                <div class="returnPrice">Rs.<?= $citem['selling_price'] ?></div>
                            </div>
                        </a>
                    <?php
                        $count++;
                        $totalPrice += $citem['selling_price'] * $citem['prod_qty'];
                    }
                    ?>
                </div>
            </div>


            <div class="right">
                <h3>Billing Address</h3>
                <form method="POST">
                    <div class="group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" id="name" required value="<?= isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>">
                    </div>
                    <div class="group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" onInput="checkEmail()" required value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">
                    </div>
                    <div class="group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address">
                    </div>
                    <div class="sahii">
                        <div class="group">
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" id="phone" required value="<?= isset($_SESSION['phone']) ? $_SESSION['phone'] : ''; ?>">
                        </div>

                        <div class="group">
                            <label for="city">City</label>
                            <input type="text" name="city" id="city" required>
                        </div>
                    <?php if(isset($_SESSION['message']))
                    { 
                    ?>
                    <?= $_SESSION['message'];?>
                    <?php
                    unset($_SESSION['message']);
                    } 
                    ?>
                    </div>
                    <div class="return">
                        <div class="row">
                            <div>Shipping</div>
                            <div class="totalQuantity">Rs.0</div>
                        </div>
                        <div class="row">
                            <div>Total Price</div>
                            <div class="totalPrice">Rs.<?= $totalPrice ?></div>
                        </div>
                        
                        <input type="hidden" name='payment_mode' value="COD">
                        <input type="hidden" name='payment_id' value="-">
                        <button type="submit" class="buttonCheckout" name="placeOrderBtn">Confirm your order</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../Products/sbook.js"></script> 
</body>

</html>