<?php 
if(!isset($_SESSION['auth']))
{
    redirect("../Login/login.php", "Login to Continue.");;
}
?>