<?php
session_start();
require '../../Dashboard/configer/dbcon.php';

function getAll($table)
{
    global $con;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($con, $query);
}

function getByID($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id='$id'";
    return $query_run = mysqli_query($con, $query);
}


function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit();

}

function getAllOrders()
{
    global $con;
    $query = "SELECT * FROM orders WHERE status='0'";
    return $query_run = mysqli_query($con, $query);
}

function getOrderHistory()
{
    global $con;
    $query = "SELECT * FROM orders WHERE status !='0' ";
    return $query_run = mysqli_query($con, $query);
}

function checkTrackingNoValid($trackingNo)
{
    global $con;

    $query = "SELECT * FROM orders WHERE tracking_no='$trackingNo'";
    return mysqli_query($con, $query);
    
}

function validateFullName($name) {
    $pattern = '/^[a-zA-Z][a-zA-Z\s.\'-]*$/';
    return preg_match($pattern, $name);
}

function validateAuthor($author) {    
    $pattern = '/^[a-zA-Z][a-zA-Z\s.\'-]*$/';
    return preg_match($pattern, $author);
}

function validateLanguage($language) {
    $pattern = '/^[a-zA-Z ]+$/';
    return preg_match($pattern, $language);
}

function validateAddress($address) 
{
    $pattern = '/^[a-zA-Z][a-zA-Z\s]*$/';
    return preg_match($pattern, $address);
}
?>