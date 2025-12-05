<?php
require '../middleware/adminMiddleware.php';
include('header.php');
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h4> Products </h4>
                </div>
                <div class="card-body" id="products_table">
                    <table class="table table-bordered table-striped" style="text-align: center;" border:1px solid #ddd>
                        <thead>
                            <tr>
                                <th class="col-md-1" rowspan="2">S.N.</th>
                                <th class="col-md-1">Name</th>
                                <th class="col-md-1">Image</th>
                                <th class="col-md-1">Status</th>
                                <th class="col-md-1">Edit</th>
                                <th class="col-md-1">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                               $products = getAll("products");

                               if(mysqli_num_rows($products) > 0)
                               {
                                $count=1;
                                 foreach($products as $item)
                                 {
                                    ?>
                                    <tr>
                                     <td><?= $count ?></td>
                                     <td><?= $item['name']; ?></td>
                                     <td>
                                        <img src="./uploads/<?= $item['image']; ?>" width="50px" height="50px" alt="<?= $item['name']; ?>">
                                     </td>
                                     <td>
                                        <?= $item['status'] == '0' ? "visible" : "Hidden"; ?>
                                     </td>
                                     <td>
                                        <a href="edit-product.php?id=<?= $item['id']; ?>" class="btn btn-primary col-md-6">Edit</a>
                                     </td> 
                                     <td>
                                        <button type="button" class="btn btn-danger delete_product_btn col-md-6" value="<?= $item['id']; ?>">Delete</button>
                                     </td>
                                    </tr>   

                                    <?php
                                    $count++;
                                 }
                               }
                               else
                               {
                                 echo "No records found";
                               }
                             ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>   
<?php include('footer.php');?>