<?php
require '../middleware/adminMiddleware.php';
include('header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Category</h4>
                </div>
                <div class="card-body">
                    <form action="./code.php" method="POST" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-12">
                            <label for="">Name<span Style="color:red"> *</span></label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <!-- <div class="col-md-6">
                            <label for="">Slug</label>
                            <input type="text" name="" class="form-control">
                        </div> -->
                        <div class="col-md-12">
                            <label for="">Description<span Style="color:red"> *</span></label>
                            <textarea rows="3" name="description" class="form-control"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="">Upload Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="">Meta Description</label>
                            <textarea rows="3" name="meta_description" class="form-control"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="">Meta Keywords</label>
                            <textarea rows="3" name="meta_keywords" class="form-control"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="">Status<span Style="color:red"> *</span></label>
                            <input type="checkbox" name="status">
                        </div>
                        <div class="col-md-6">
                            <label for="">Popular</label>
                            <input type="checkbox" name="popular">
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" name="add_category_btn">Save</button>
                        </div>
                     </div>
                   </form>
                </div>
            </div>
        </div>

    </div>
</div>    
<?php include('footer.php');?>