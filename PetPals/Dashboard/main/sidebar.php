<?php 
  $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/")+1);
?>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">

<div class="sidenav-header">
  <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
  <a class="navbar-brand m-0" href="../../Home/Index.php " target="_blank">
    <!-- <img src="./assets/Image/logo1.png" class="navbar-brand-img h-100" alt="main_logo"> -->
    <!-- <span class="ms-1 font-weight-bold text-white fs-5">PetPals Admin</span> -->
    <div class="d-flex justify-content-center">
    <span class="ms-1 font-weight-bold text-white fs-5">PetPals Admin</span>
</div>
  </a>
</div>


<hr class="horizontal light mt-0 mb-2">

<div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
  <ul class="navbar-nav">

<li class="nav-item">
<a class="nav-link text-white <?= $page == "admin.php" ? "active bg-gradient-primary" : "" ?>" href="admin.php">
  
    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
      <i class="material-icons opacity-10">dashboard</i>
    </div>
  
  <span class="nav-link-text ms-1">Dashboard</span>
</a>
</li>
<li class="nav-item">
<a class="nav-link text-white <?= $page == "blogs.php" ? "active bg-gradient-primary" : "" ?>" href="blogs.php">
  
    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
      <i class="material-icons opacity-10">table_view</i>
    </div>
  
  <span class="nav-link-text ms-1">All Blogs</span>
</a>
</li>
<li class="nav-item">
<a class="nav-link text-white <?= $page == "add-blogs.php" ? "active bg-gradient-primary" : "" ?>" href="add-blogs.php">
  
    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
      <i class="material-icons opacity-10">add</i>
    </div>
  
  <span class="nav-link-text ms-1">Add Blogs</span>
</a>
</li>

<li class="nav-item">
<a class="nav-link text-white <?= $page == "category.php" ? "active bg-gradient-primary" : "" ?>" href="./category.php">
  
    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
      <i class="material-icons opacity-10">table_view</i>
    </div>
  
  <span class="nav-link-text ms-1">All Categories</span>
</a>
</li>

<li class="nav-item">
<a class="nav-link text-white <?= $page == "add-category.php" ? "active bg-gradient-primary" : "" ?>" href="./add-category.php">
  
    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
      <i class="material-icons opacity-10">add</i>
    </div>
  
  <span class="nav-link-text ms-1">Add Category</span>
</a>
</li>
<li class="nav-item">
<a class="nav-link text-white <?= $page == "products.php" ? "active bg-gradient-primary" : "" ?>" href="./products.php">
  
    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
      <i class="material-icons opacity-10">table_view</i>
    </div>
  
  <span class="nav-link-text ms-1">All Products</span>
</a>
</li>



<li class="nav-item">
<a class="nav-link text-white <?= $page == "add-products.php" ? "active bg-gradient-primary" : "" ?>" href="./add-products.php">
  
    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
      <i class="material-icons opacity-10">add</i>
    </div>
  
  <span class="nav-link-text ms-1">Add Products</span>
</a>
</li>

<li class="nav-item">
<a class="nav-link text-white <?= $page == "orders.php" ? "active bg-gradient-primary" : "" ?>" href="./orders.php">
  
    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
      <i class="material-icons opacity-10">table_view</i>
    </div>
  
  <span class="nav-link-text ms-1">Orders</span>
</a>
</li>


<div class="sidenav-footer position-absolute w-100 bottom-0 ">
  <div class="mx-3">
    <a class="btn bg-gradient-primary w-100" 
    href="../../Login/logout.php" type="button">Log out</a>
  </div>
  
</div>

</aside>