<?php
require '../middleware/adminMiddleware.php';

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
    <title>Novelty</title>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css? family=kaushan+script|popping&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="./view-order.css">
</head>
<body>

	<div class="container">

		<div class="left">
           <a href="./orders.php" alt=""><i class="bx bx-chevron-left data"></i>Back to order</a>
             
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
				<div id="zip">
					<label>
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
            <form  action="code.php" method="POST">
				 
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
                                 $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.qty as quantity, oi.*, p.* FROM orders o, order_items oi,
                                 products p WHERE oi.order_id=o.id AND p.id=oi.prod_id AND o.tracking_no='$tracking_no'";

                                 $order_query_run = mysqli_query($con, $order_query);

                                 if(mysqli_num_rows($order_query_run) > 0)
                                 {
                                     foreach($order_query_run as $item)
                                     {
                                        ?>
                                        <tr>
                                            <td><img src="./uploads/<?= $item['image'] ?>" alt="<?= $item['name'] ?>"></td>
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
                        
                            <input type="hidden" name="tracking_no" value="<?= $data['tracking_no'] ?>">
                        <select name="order_status">
                            <option value="0" <?= $data['status'] == 0?"Selected":"" ?>>Under Process</option>
                            <option value="1" <?= $data['status'] == 1?"Selected":"" ?>>Completed</option>
                            <option value="2" <?= $data['status'] == 2?"Selected":"" ?>>Cancelled</option>
                        </select>

                        <button type="submit" class="normal" name="update_order_btn">Update</button>
                        
                    </form>
		</div>
	</div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../Products/sbook.js"></script>
</body>
</html>