<?php
include('../Login/functions/userMyfunctions.php'); 
include('../Dashboard/middleware/authenticate.php');

if(isset($_GET['t']))
{
    $tracking_no = $_GET['t'];

    $orderData = checkTrackingNoValid($tracking_no);
    if(mysqli_num_rows($orderData) < 0)
    {
       ?>
      <h4>Something went wrong</h4>
      <?php
      die();
    }
}
else
{
    ?>
      <h4>Something went wrong</h4>
    <?php
    die();
}

$data = mysqli_fetch_array($orderData);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetPals</title>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css? family=kaushan+script|popping&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="./view-order.css">
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
 
<div class="head-container">
	    <div class="container">

		   <div class="left">
           <a href="./my-orders.php" alt=""><i class="bx bx-chevron-left data"></i>Back to order</a>
             
			<h3>Delivery Address</h3>
			<form>
				<b>Full name</b>
				<input type="text" name="name" value="<?= $data['name'];?>" disabled>
				<b>Email</b>
				<input type="text" name="email" value="<?= $data['email'];?>"disabled>

				<b>Address</b>
				<input type="text" name="address" value="<?= $data['address'];?>"disabled>
				
				<b>Phone</b>
				<input type="text" name="phone" value="<?= $data['phone'];?>"disabled>
				<div class="zip">
					<label class="f1">
						        <b>City</b>
                    <input type="text" name="city" value="<?= $data['city'];?>"disabled>
                    </label>
                    <label class="f2">
                    <b>Payment Mode</b>
                    
                    <input type="text" name="" value="<?= $data['payment_mode'] ?>"disabled>
                    </label>
				</div>
                
                        
                        
                        
			</form>
		</div>
		<div class="right">
			<h3>Order Details</h3>
            <form>
				 
                        <table>
                            <thead>
                            <tr>
                                <td><b>Image</b></td>
                                <td><b>Name</b></td>
                                <td><b>Price</b></td>
                                <td><b>Quantity</b></td>
                            </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                 $userId = $_SESSION['auth_user']['user_id'];
                                 $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.qty as quantity, oi.*, p.* FROM orders o, order_items oi,
                                 products p WHERE o.user_id='$userId' AND oi.order_id=o.id AND p.id=oi.prod_id AND o.tracking_no='$tracking_no'";

                                 $order_query_run = mysqli_query($con, $order_query);

                                 if(mysqli_num_rows($order_query_run) > 0)
                                 {
                                     foreach($order_query_run as $item)
                                     {
                                        ?>
                                        <tr>
                                            <td><img src="../Dashboard/main/uploads/<?= $item['image'] ?>" alt="<?= $item['name'] ?>"></td>
                                            <td><?= $item['name'] ?></td>
                                            <td>Rs.<?= $item['price'] ?></td>
                                            <td>x<?= $item['quantity'] ?></td>
                                            
                                        </tr>
                     
                                        <?php
                                    }
                                 }
                                ?>
                                
                            </tbody>
                        </table>
               
                        <br><br>
                        
                        <b>Total Price</b>
                        <input type="text" name="" value="Rs.<?= $data['total_price'] ?>" disabled>
                        <br>
                        
						             <b>Status</b>
						            <input type="text" name="status" 
                        value="<?php 
                           if($data['status'] == 0 )
                           {
                             echo "Under Process";
                           }
                           else if($data['status'] == 1 )
                           {
                             echo "Completed";
                           }
                           else if($data['status'] == 2 )
                           {
                             echo "Cancelled";
                           }
                        ?>"
                        disabled>
					             </label>
                    </form>
		</div>
   
	</div>
 
  <div class="btn-1">
  <button data-modal-target="#modal"><i class="bx bx-user"></i></button>
  <div class="modal" id="modal">
    <div class="modal-header">
      <div class="title"><p>Hello!! <b><?= $_SESSION['name'] ?></b></p></div>
      <button data-close-button class="close-button">&times;</button>
    </div>
    <div class="modal-body">
      <p>If you wish to cancel your order, please message us:</p>
      <p><span>NAME < space > TRACKING_NUMBER  < space > CANCEL</span></p>
      <p>and send it to:  <span>9808389105 / 9840802525</span></p>

      <p>We are here to help! Feel free to reach out.</p>
    </div>
  </div>
  <div id="overlay"></div>
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
        <script src="./view-order.js"></script>
        
</body>
</html>