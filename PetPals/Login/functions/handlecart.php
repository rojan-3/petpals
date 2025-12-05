<?php
session_start();
require '../../Dashboard/configer/dbcon.php';

if(isset($_SESSION['auth']))
{
    if(isset($_POST['scope']))
    {
        $scope = $_POST['scope'];
        
        switch($scope)
        {
            case "add":
                $prod_id = $_POST['prod_id'];
                $prod_qty = $_POST['prod_qty'];

                $user_id = $_SESSION['auth_user']['user_id'];
                
                $check_existing_cart = "SELECT * FROM carts WHERE prod_id='$prod_id' AND user_id='$user_id'";
                $check_existing_cart_run = mysqli_query($con, $check_existing_cart);
                
                if(mysqli_num_rows($check_existing_cart_run) > 0)
                {
                     echo "Existing";
                }
                else
                {
                $insert_query = "INSERT INTO carts (user_id, prod_id, prod_qty) VALUE ('$user_id', '$prod_id', '$prod_qty')";
                $insert_query_run = mysqli_query($con, $insert_query);

                if($insert_query_run)
                {
                    echo 201;
                }
                else
                {
                    echo 500;
                }
                }
                break;

            case "update":
                $prod_id = $_POST['prod_id'];
                $prod_qty = $_POST['prod_qty'];

                $user_id = $_SESSION['auth_user']['user_id'];

                $check_existing_cart = "SELECT * FROM carts WHERE prod_id='$prod_id' AND user_id='$user_id'";
                $check_existing_cart_run = mysqli_query($con, $check_existing_cart);
                
                if(mysqli_num_rows($check_existing_cart_run) > 0)
                {
                    $update_query = "UPDATE carts SET prod_qty='$prod_qty' WHERE 
                    prod_id = '$prod_id' AND user_id='$user_id'";

                    $update_query_run = mysqli_query($con, $update_query);
                    if($update_query_run)
                    {
                        echo 200;
                    }
                    else
                    {
                        echo 500;
                    }
                }
                else
                {
                    echo "Something went Wrong";
                }
                break;

                case "delete":
                $cart_id = $_POST['cart_id'];
                $user_id = $_SESSION['auth_user']['user_id'];
                $check_existing_cart = "SELECT * FROM carts WHERE id='$cart_id' AND user_id='$user_id'";
                $check_existing_cart_run = mysqli_query($con, $check_existing_cart);
                
                if(mysqli_num_rows($check_existing_cart_run) > 0)
                {
                    $delete_query = "DELETE FROM carts WHERE id='$cart_id'";
                    $delete_query_run = mysqli_query($con, $delete_query);
                    if($delete_query_run)
                    {
                        echo 200;
                    }
                    else
                    {
                        echo "Something went Wrong";
                    }
                }
                else
                {
                    echo "Something went Wrong";
                }
                break;
                default:
                    echo 500;
        }
    }
}
else
{
    echo 401;
}
?>