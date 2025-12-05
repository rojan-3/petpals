<?php 
require '../../Dashboard/configer/dbcon.php';

if(isset($_POST['news_btn']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $insert_query = "INSERT INTO news (email) VALUES ('$email')";
        $insert_query_run = mysqli_query($con, $insert_query);

        if($insert_query_run)
        {
            $_SESSION['message'] = "Registration Successful";
            header('Location: ../../Home/index.php');
        }
        else
        {
            $_SESSION['message'] = "Something went wrong";
            header('Location: ../../Home/index.php');
        }
}
?>