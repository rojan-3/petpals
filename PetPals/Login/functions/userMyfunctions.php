<?php
session_start();
require '../Dashboard/configer/dbcon.php';

function getAllActive($table)
{
    global $con;
    $query = "SELECT * FROM $table WHERE status='0' ";
    return $query_run = mysqli_query($con, $query);
}


function getSlugActive($table, $slug)
{
    global $con;
    $query = "SELECT * FROM $table WHERE slug='$slug' AND status='0' LIMIT 1";
    return $query_run = mysqli_query($con, $query);
}

function getProdByCategory($category_id)
{
    global $con;
    $query = "SELECT * FROM products WHERE category_id='$category_id' AND status='0'";
    return $query_run = mysqli_query($con, $query);
}

function getIDActive($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id='$id' AND status='0'";
    return $query_run = mysqli_query($con, $query);
}

function getCartItems()
{
    global $con;
    $user_id = $_SESSION['auth_user']['user_id'];
    $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price
    FROM carts c, products p WHERE c.prod_id=p.id AND c.user_id='$user_id' ORDER BY c.id DESC";
    return $query_run = mysqli_query($con, $query);
}

function getOrders()
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];

    $query = "SELECT * FROM orders WHERE user_id='$userId' ORDER BY id DESC";
    return $query_run = mysqli_query($con, $query);
}

function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit();
}

function checkTrackingNoValid($trackingNo)
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];

    $query = "SELECT * FROM orders WHERE tracking_no='$trackingNo' AND user_id='$userId'";
    return mysqli_query($con, $query);
    
}

function validateFullName($name) {
    $pattern = '/^[a-zA-Z ]+$/';
    return preg_match($pattern, $name);
}

function validateCity($city) {
    $pattern = '/^[a-zA-Z ]+$/';
    return preg_match($pattern, $city);
}

function validateAddress($address) {
    $pattern = '/^[a-zA-Z ]+$/';
    return preg_match($pattern, $address);
}
?>