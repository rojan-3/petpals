<?php
require '../middleware/adminMiddleware.php';
include('header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Blogs</h4>
                </div>
                <div class="card-body">
                    <form action="./code.php" method="POST" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <label class="mb-0" for="">Name<span Style="color:red"> *</span></label>
                            <input type="text" name="name" class="form-control mb-2">
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0" for="">Upload Image<span Style="color:red"> *</span></label>
                            <input type="file" name="image" class="form-control mb-2">
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0" for="">Description<span Style="color:red"> *</span></label>
                            <textarea rows="3" name="description" class="form-control mb-2"></textarea>
                        </div>
                        
                        <div class="col-md-3">
                            <label class="mb-3" for="">Status<span Style="color:red"> *</span></label>
                            <input type="checkbox" name="status">
                        </div>
                        
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" name="add_blog_btn">Save</button>
                        </div>
                     </div>
                   </form>
                </div>
            </div>
        </div>

    </div>
</div>    
<?php include('footer.php');?>