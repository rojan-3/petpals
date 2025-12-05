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
              $product = getByID("products", $id);

              if(mysqli_num_rows($product) > 0)
              {
                $data = mysqli_fetch_array($product);
                ?>
                  <div class="card">
                    <div class="card-header">
                        <h4>Edit Products
                        <a href="./products.php" class="btn btn-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="./code.php" method="POST" enctype="multipart/form-data">
                          <div class="row">
                          <div class="col-md-12">
                                <label class="mb-0" for="">Select Category</label>
                                <select name="category_id" class="form-select mb-2">
                                <option selected></option>
                                    <?php
                                    $categories = getAll("categories");
    
                                    if(mysqli_num_rows($categories) > 0)
                                    {
                                      foreach($categories as $item)
                                      {
                                        ?>
                                        <option value="<?= $item['id']; ?>"<?= $data['category_id'] == $item['id']? 'selected': ''?>  ><?= $item['name']; ?></option>                                    
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
                            <input type="hidden" name="product_id" value="<?= $data['id']; ?>">
                            <div class="col-md-6">
                                <label class="mb-0" for="">Name</label>
                                <input type="text" name="name" value="<?= $data['name']; ?>" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0" for="">Brand</label>
                                <input type="text" name="brand" value="<?= $data['brand']; ?>" class="form-control mb-2">
                            </div>
                            
                            <div class="col-md-12">
                                <label class="mb-0" for="">Small Description</label>
                                <textarea rows="3" name="small_description" class="form-control mb-2"><?= $data['small_description'];?></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0" for="">Description</label>
                                <textarea rows="3" name="description" class="form-control mb-2"><?= $data['description'];?></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0" for="">Original Price</label>
                                <input type="text" name="original_price" value="<?= $data['original_price']; ?>" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0" for="">Selling Price</label>
                                <input type="text" name="selling_price" value="<?= $data['selling_price']; ?>" class="form-control mb-2">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0" for="">Upload Image</label>
                                <input type="hidden" name="old_image" value="<?= $data['image'];?>">
                                <input type="file" name="image" class="form-control mb-2">
                                <label class="mb-0" for="">Current Image</label>
                                <img src="./uploads/<?= $data['image'];?>" alt="Product Image" height="50px" width="50px">
                            </div>
                            <div class="col-md-3">
                                <label class="mb-0" for="">Quantity</label>
                                <input type="number" name="qty" value="<?= $data['qty']; ?>" class="form-control mb-2">
                            </div>
                            <div class="col-md-3">
                                <label class="mb-0" for="">Slug</label>
                                <input type="text" name="slug" value="<?= $data['slug']; ?>" class="form-control mb-2">
                            </div>                           
                            <div class="col-md-3">
                                <label class="mb-0" for="">Status</label><br>
                                <input type="checkbox" <?= $data['status'] == '0' ? 'checked' : ''?> name="status">
                            </div>
                            <div class="col-md-3">
                                <label class="mb-0" for="">Trending</label><br>
                                <input type="checkbox" <?= $data['trending'] == '0' ? 'checked' : ''?> name="trending">
                            </div>
                            <!-- <div class="col-md-3">
                            <label class="mb-0" for="">Page Count</label>
                            <input type="text" name="page_count" value="<?= $data['page_count']; ?>" class="form-control mb-2">
                        </div>  -->
                        <div class="col-md-3">
                            <label class="mb-0" for="">Weight</label>
                            <input type="text" name="weight" value="<?= $data['weight']; ?>" class="form-control mb-2">
                        </div> 
                        <div class="col-md-3">
                            <label class="mb-0" for="">SKU</label>
                            <input type="text" name="sku" value="<?= $data['sku']; ?>" class="form-control mb-2">
                        </div> 
                        <!-- <div class="col-md-3">
                            <label class="mb-0" for="">Language</label>
                            <input type="text" name="language" value="<?= $data['language']; ?>" class="form-control mb-2">
                        </div>      -->
                            <div class="col-md-12">
                                <label class="mb-0" for="">Meta Title</label>
                                <input type="text" name="meta_title" value="<?= $data['meta_title']; ?>" class="form-control mb-2">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0" for="">Pets</label>
                                <textarea rows="3" name="meta_description" value="" class="form-control mb-2"><?= $data['meta_description']; ?></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0" for="">Meta Keywords</label>
                                <textarea rows="3" name="meta_keywords" value="" class="form-control mb-2"><?= $data['meta_keywords']; ?></textarea>
                            </div>
                            
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="update_product_btn">Update</button>
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
                echo "Product not Found for given ID";
              }

           
            }
            else
            {
                echo "Id Missing from utl";
            }
        ?>

    </div>
</div>    
<?php include('footer.php');?>