<?php
include('../../Login/functions/myfunctions.php');
if(isset($_SESSION['auth']))
{
    if($_SESSION['role_as'] != 1)
    {
        redirect("../../Home/Index.php", "You are not authorized to access this page.");
    }

}
else
{
    redirect("../../Login/login.php", "Login to Continue.");
}
?>