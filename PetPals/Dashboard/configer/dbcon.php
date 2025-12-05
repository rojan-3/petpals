<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "petpals";

    //Creating database connection
    $con = mysqli_connect($host, $username, $password, $database, 3306);

    //Checking database connection
    if(!$con)
    {
        die("Connection failed: ". mysqli_connect_error());
    }
    
?>