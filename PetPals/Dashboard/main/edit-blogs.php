<?php
require '../middleware/adminMiddleware.php';
include('header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $blog = getByID("blogs", $id);

                if(mysqli_num_rows($blog) > 0)
                {
                    $data = mysqli_fetch_array($blog);
                ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Blogs
                            <a href="./blogs.php" class="btn btn-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="./code.php" method="POST" enctype="multipart/form-data">
                          <div class="row">
                            <input type="hidden" name="blog_id" value="<?= $data['id'] ?>">
                            <div class="col-md-12">
                                <label for="">Name</label>
                                <input type="text" name="name" value="<?= $data['name'] ?>" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="">Upload Image</label>
                                <input type="file" name="image"  class="form-control">
                                <label for="">Current Image</label>
                                <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                <img src="./uploads/<?= $data['image'] ?>" height="50px" width="50px" alt="">
                            </div>
                            <div class="col-md-12">
                                <label for="">Description</label>
                                <textarea rows="3" name="description"  class="form-control"><?= $data['description'] ?></textarea>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="">Status</label>
                                <input type="checkbox" <?= $data['status'] ? "" : "checked" ?> name="status">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="update_blog_btn">Update</button>
                            </div>
                         </div>
                       </form>
                    </div>
                </div>
                </div>
                <?php
                }
                else
                {
                    echo "blog not found";
                }
            } 
            else
            {
                echo "ID Miss Cha Hai URL Bata!!";
            }
            ?>
           

    </div>
</div>    
<?php include('footer.php');?>