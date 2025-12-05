<?php
require '../middleware/adminMiddleware.php';
include('header.php');

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h4> Categories </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" style="text-align: center;" border:1px solid #ddd>
                        <thead>
                            <tr>
                                <th class="col-md-1" rowspan="2">Id</th>
                                <th class="col-md-1">Name</th>
                                <th class="col-md-1">Image</th>
                                <th class="col-md-1">Status</th>
                                <th class="col-md-1">Edit</th>
                                <th class="col-md-1">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                               $category = getAll("categories");

                               if(mysqli_num_rows($category) > 0)
                               {
                                $count=1;
                                 foreach($category as $item)
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
                                        <a href="edit-category.php?id=<?= $item['id']; ?>" class="btn btn-primary col-md-6">Edit</a>
                                     </td> 
                                     <td>
                                        <form action="./code.php" method="POST">
                                        <input type="hidden" name="category_id" value="<?= $item['id']; ?>">
                                        <button type="submit" class="btn btn-danger  col-md-6" name="delete_category_btn">Delete</button>
                                        </form>
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