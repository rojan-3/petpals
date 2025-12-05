<?php
include('../Login/functions/userMyfunctions.php');

if (isset($_GET['product'])) {
  $product_slug = $_GET['product'];
  $product_data = getSlugActive("products", $product_slug);
  $product = mysqli_fetch_array($product_data);

  if ($product) {
    // Check if the product has quantity available
    $product_category = $product['category_id'];
    $availableQty = $product['qty'];
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
      <link rel="stylesheet" href="./sproduct.css">
      <!-- <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Initialize the quantity and buttons
                    const qtyInput = document.querySelector(".input-qty");
                    const incrementBtn = document.querySelector(".increment-btn");
                    const decrementBtn = document.querySelector(".decrement-btn");
                    const availableQty = parseInt(qtyInput.getAttribute("data-available-qty"));
                    
                    // Increment button event
                    incrementBtn.addEventListener("click", function() {
                        let currentQty = parseInt(qtyInput.value);
                        if (currentQty < availableQty) {
                            qtyInput.value = currentQty + 1;
                        } else {
                            // alert("Maximum quantity reached");
                        }
                    });

                    // Decrement button event
                    decrementBtn.addEventListener("click", function() {
                        let currentQty = parseInt(qtyInput.value);
                        if (currentQty > 1) {
                            qtyInput.value = currentQty - 1;
                        }
                    });
                });
            </script> -->
    </head>

    <body>
      <div class="navbar">
        <a href="../Home/Index.php"><img src="./Images/logo.png" class="logo"></a>
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
        </div>

      </div>

      <!-------------- Single product ------------------------->
  <section id="prodetails" class="section-p2  background  product_data">
    <div class="single-pro-image">
      <h5><a href="./Product.php"><i class="bx bx-chevron-left data"></i> Back to Products</a></h5>
      <div class="khatra">
        <img src="../Dashboard/main/uploads/<?= $product['image']; ?>" width="100%" alt="Single Image"> <br>
      </div>
      <h4>Pets: </h4>
      <p>
        <?= $product['meta_description'] ?>
      </p>
    </div>
    <div class="single-pro-details">
      <div>
        <h6>
          <?= $product['meta_keywords'] ?>
        </h6>
      </div>
      <h2>
        <?= $product['name'] ?>
      </h2>
      <p class="h5">Brand:
        <?= $product['brand'] ?>
      </p>

      <h3>Rs.
        <?= $product['selling_price'] ?>
      </h3>

      <!-- <div class="row1">
                      <button class="minus decrement-btn"><i class="bx bx-chevron-left data"></i></button>
                      <input type="text" class="input-qty" value="1" disabled>
                      <button class="plus increment-btn"><i class="bx bx-chevron-right data"></i></button>
                      </div> -->


          <!-- Check if quantity is available
                      <?php if ($availableQty > 0) { ?>
                      <button class="normal addToCartBtn" value="<?= $product['id']; ?>"><i class="fa fa-shopping-cart"></i>Add To Cart</button>
                     <?php } else { ?>
                     <button class="normal" disabled><i class="fa fa-shopping-cart"></i> Out of Stock</button>
                     <?php } ?> -->

          <!-- Quantity control with data-available-qty attribute -->
          <div class="row1">
            <button class="minus decrement-btn"><i class="bx bx-chevron-left data"></i></button>
            <input type="text" class="input-qty" value="1" data-available-qty="<?= $availableQty; ?>" disabled>
            <button class="plus increment-btn"><i class="bx bx-chevron-right data"></i></button>
          </div>

          <!-- Add to cart button with quantity check -->
          <?php if ($availableQty > 0) { ?>
            <button class="normal addToCartBtn" value="<?= $product['id']; ?>" data-qty="<?= $availableQty; ?>"><i
                class="fa fa-shopping-cart"></i> Add To Cart</button>
          <?php } else { ?>
            <button class="normal" disabled><i class="fa fa-shopping-cart"></i> Out of Stock</button>
          <?php } ?>



          <!-- <button class="normal addToCartBtn" value="<?= $product['id']; ?>"><i class="fa fa-shopping-cart"></i>Add To Cart</button> -->
          <!-- <button class="normal addToWishBtn" value="<?= $product['id']; ?>"><i class="fa fa-heart"></i>Add To Wishlist</button> -->
          <h4>About the Product</h4>
          <!-- <span><?= $product['description'] ?></span> -->
          <span style="display: block; text-align: justify;"><?= $product['description'] ?></span>

          <!-- Other Info -->
          <div class="mainOther">
            <h4>Other info</h4>
            <div class="other">
              <div class="smallBox">
                <!-- <div class="otherInfo">
                        <p>Page Count</p>
                        <i class="fa fa-book"></i>
                        <h5><?= $product['page_count'] ?></h5>
                      </div> -->
                <div class="otherInfo">
                  <p>Weight</p>
                  <i class="fa fa-shopping-bag"></i>
                  <h5><?= $product['weight'] ?></h5>
                </div>
                <div class="otherInfo">
                  <p>SKU</p>
                  <i class="fa fa-barcode"></i>
                  <h5><?= $product['sku'] ?></h5>
                </div>
                <!-- <div class="otherInfo">
                        <p>Language</p>
                        <i class="fa fa-globe"></i>
                        <h5><?= $product['language'] ?></h5>
                      </div> -->
              </div>
            </div>
          </div>



        </div>
        <div class="single-pro-side">
          <div class="single-pro-sideBar1">
            <div class="single-pro-sideBar">
              <i class="fa fa-car"></i>
              <p>Free Delivery</p>
            </div>
            <div class="single-pro-sideBar">
              <i class="fa fa-credit-card"></i>
              <p>Pay on Delivery</p>
            </div>
            <div class="single-pro-sideBar">
              <i class="fa fa-archive"></i>
              <p>Replacement</p>
            </div>
            <!-- <div class="single-pro-sideBar">
                           <i class="fa fa-truck"></i>
                           <p>Novelty Delivered</p>
                           </div> -->
            <div class="single-pro-sideBar">
              <i class="fa fa-user"></i>
              <p>Secure Transection</p>
            </div>
          </div>

        </div>
      </section>

      <!-------------------------- Recommendation ------------------------>
      <section id="product1" class="section-p1">
        <div class="title-text">
          <p>PRODUCTS</p>
          <h1>You may also like</h1>
        </div>
        <div class="pro-container">

          <!-- <?php
          $current_product_id = $product['id'];
          $query = "SELECT * FROM products WHERE status='0' ORDER BY id DESC LIMIT 8";
          // Collaborative Filtering: Get products from the same category 
          $query = "SELECT * FROM products WHERE category_id = '$product_category' AND id != '$current_product_id' AND status = '0' ORDER BY RAND() LIMIT 8";
          $query_run = mysqli_query($con, $query);
          $check_products = mysqli_num_rows($query_run) > 0;

          if ($check_products) {
            while ($row = mysqli_fetch_array($query_run)) {
              ?>
                <a href="./sproduct.php?product=<?= $row['slug']; ?>">
                    <div class="pro">
                        <img src="../Dashboard/main/uploads/<?= $row['image']; ?>" alt="All Images">
                        <div class="des">
                            <span><?= $row['name']; ?></span>
                            <h5><?= $row['brand']; ?></h5>
                            <div class="star">
                                <i class="fa fa-paw"></i>
                                <i class="fa fa-paw"></i>
                                <i class="fa fa-paw"></i>
                                <i class="fa fa-paw"></i>
                                <i class="fa fa-paw"></i>
                            </div>
                            <h4>Rs.<?= $row['selling_price']; ?></h4>
                        </div>
                    </a>
                    <button class="addToCartBtn" value="<?= $row['id']; ?>"><i class="fa fa-shopping-cart"></i></button>
                </div>
                <?php
            }
          } else {
            echo "No Related Products Found";
          }
          ?> -->

          <?php
          $current_product_id = $product['id'];
          $product_category = $product['category_id']; // Assuming you have the category ID in $product['category_id']
      
          // Fetch related products from the database
          $query = "SELECT * FROM products WHERE category_id = '$product_category' AND id != '$current_product_id' AND status = '0'";
          $query_run = mysqli_query($con, $query);

          $products = [];
          if (mysqli_num_rows($query_run) > 0) {
            while ($row = mysqli_fetch_assoc($query_run)) {
              $products[] = $row;
            }

            // Bubble sort based on 'selling_price'
            $n = count($products);
            for ($i = 0; $i < $n - 1; $i++) {
              for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($products[$j]['selling_price'] > $products[$j + 1]['selling_price']) {
                  // Swap products
                  $temp = $products[$j];
                  $products[$j] = $products[$j + 1];
                  $products[$j + 1] = $temp;
                }
              }
            }

            // Display only the first 8 sorted products
            $display_limit = 8;
            $count = 0;
            foreach ($products as $row) {
              if ($count >= $display_limit)
                break; // Stop after 8 products
              ?>
              <a href="./sproduct.php?product=<?= $row['slug']; ?>">
                <div class="pro">
                  <img src="../Dashboard/main/uploads/<?= $row['image']; ?>" alt="All Images">
                  <div class="des">
                    <span><?= $row['name']; ?></span>
                    <h5><?= $row['brand']; ?></h5>
                    <div class="star">
                      <i class="fa fa-paw"></i>
                      <i class="fa fa-paw"></i>
                      <i class="fa fa-paw"></i>
                      <i class="fa fa-paw"></i>
                      <i class="fa fa-paw"></i>
                    </div>
                    <h4>Rs.<?= $row['selling_price']; ?></h4>
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
            $count++; // Increment the counter
            }
          } else {
            echo "No Related Products Found";
          }
          ?>


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
      <?php
  } else {
    echo "Product Not Found";
  }
  ?>
    <?php
} else {
  echo "Something went Wrong";
}
?>

  <script>
    let subMenu = document.getElementById("subMenu");

    function toggleMenu() {
      console.log("Function called");
      subMenu.classList.toggle("open-menu");
    }
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="./sbook.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>