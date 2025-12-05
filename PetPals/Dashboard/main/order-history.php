<?php
require '../middleware/adminMiddleware.php';
include('header.php');
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h4> Order History
                    <a href="orders.php" class="btn btn-warning float-end"> Back </a>
                   </h4>
                </div>
                <div class="card-body" id="products_table">
                    <table class="table table-bordered table-striped" style="text-align: center;" border:1px solid #ddd>
                        <thead>
                            <tr>
                                <th class="col-md-1">Id</th>
                                <th class="col-md-1">User</th>
                                <th class="col-md-1">Tracking Number</th>
                                <th class="col-md-1">Price</th>
                                <th class="col-md-1">Date</th>
                                <th class="col-md-1">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $orders = getOrderHistory();

                            if(mysqli_num_rows($orders))
                            {
                                foreach($orders as $item)
                                {
                                    ?>
                                        <tr>
                                            <td><?= $item['id'];?></td>
                                            <td><?= $item['name'];?></td>
                                            <td><?= $item['tracking_no'];?></td>
                                            <td><?= $item['total_price'];?></td>
                                            <td><?= $item['created_at'];?></td>
                                            <td>
                                                <a href="./view-order.php?t=<?=$item['tracking_no'];?>" class="btn btn-danger col-md-8">View Details</a>
                                            </td>
                                        </tr>
                                    
                                    <?php
                                }
                            }
                              ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>   
<?php include('footer.php');?>