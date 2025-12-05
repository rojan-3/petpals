<?php
require '../middleware/adminMiddleware.php';
include('header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Products</h4>
                </div>
                <div class="card-body">
                    <form action="./code.php" method="POST" enctype="multipart/form-data">
                      <div class="row">
                      <div class="col-md-12">
                            <label class="mb-0" for="">Select Category<span Style="color:red"> *</span></label>
                            <select name="category_id" class="form-select mb-2">
                            <option selected disabled> Select Category </option>
                                <?php
                                $categories = getAll("categories");

                                if(mysqli_num_rows($categories) > 0)
                                {
                                  foreach($categories as $item)
                                  {
                                    ?>
                                    <option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>                                    
                                    <?php
                                  }
                                }
                                else
                                {
                                    echo "No Category Available";
                                }  
                                ?>                         
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="mb-0" for="">Name<span Style="color:red"> *</span></label>
                            <input type="text" name="name" class="form-control mb-2">
                        </div>
                        <div class="col-md-6">
                                <label class="mb-0" for="">Brand<span Style="color:red"> *</span></label>
                                <input type="text" name="brand" class="form-control mb-2">
                            </div>
                        <div class="col-md-12">
                            <label class="mb-0" for="">Small Description</label>
                            <textarea rows="3" name="small_description" class="form-control mb-2"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0" for="">Description<span Style="color:red"> *</span></label>
                            <textarea rows="3" name="description" class="form-control mb-2"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="mb-0" for="">Original Price<span Style="color:red"> *</span></label>
                            <input type="text" name="original_price" class="form-control mb-2">
                        </div>
                        <div class="col-md-6">
                            <label class="mb-0" for="">Selling Price<span Style="color:red"> *</span></label>
                            <input type="text" name="selling_price" class="form-control mb-2">
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0" for="">Upload Image<span Style="color:red"> *</span></label>
                            <input type="file" name="image" class="form-control mb-2">
                        </div>
                        <div class="col-md-3">
                            <label class="mb-0" for="">Quantity<span Style="color:red"> *</span></label>
                            <input type="number" name="qty" class="form-control mb-2">
                        </div>
                        <div class="col-md-3">
                            <label class="mb-0" for="">Slug</label>
                            <input type="text" name="" class="form-control mb-2">
                        </div>   
                        <div class="col-md-3">
                            <label class="mb-0" for="">Status<span Style="color:red"> *</span></label><br>
                            <input type="checkbox" name="status">
                        </div>
                        <div class="col-md-3">
                            <label class="mb-0" for="">Trending</label><br>
                            <input type="checkbox" name="trending">
                        </div>
                        <!-- <div class="col-md-3">
                            <label class="mb-0" for="">Bag Size<span Style="color:red"> *</span></label>
                            <input type="text" name="bag_size" class="form-control mb-2">
                        </div>  -->
                        <div class="col-md-3">
                            <label class="mb-0" for="">Weight<span Style="color:red"> *</span></label>
                            <input type="text" name="weight" class="form-control mb-2">
                        </div> 
                        <div class="col-md-3">
                            <label class="mb-0" for="">SKU<span Style="color:red"> *</span></label>
                            <input type="text" name="sku" class="form-control mb-2">
                        </div> 
                        <!-- <div class="col-md-3">
                            <label class="mb-0" for="">Language<span Style="color:red"> *</span></label>
                            <input type="text" name="language" class="form-control mb-2">
                        </div>                       -->
                        
                        <div class="col-md-12">
                            <label class="mb-0" for="">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control mb-2">
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0" for="">Pets<span Style="color:red"> *</span></label>
                            <textarea rows="3" name="meta_description" class="form-control mb-2"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0" for="">Meta Keywords<span Style="color:red"> *</span></label>
                            <textarea rows="3" name="meta_keywords" class="form-control mb-2"></textarea>
                        </div>
                        
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" name="add_product_btn">Save</button>
                        </div>
                     </div>
                   </form>
                </div>
            </div>
        </div>

    </div>
</div>    
<?php include('footer.php');?>