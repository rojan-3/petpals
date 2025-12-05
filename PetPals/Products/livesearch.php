<?php
include('../Login/functions/userMyfunctions.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./Book1.css">
</head>
<?php
if(isset($_POST['input']))
{
    $input = $_POST['input'];

    $query = "SELECT * FROM products WHERE name LIKE '{$input}%' OR author LIKE '{$input}%'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result)>0)
    {
        ?>
        <?php
        while($row = mysqli_fetch_assoc($result))
        {
            
        }
        ?>
          <?php
    }
    else
    {
        echo "<h6>No data Found</h6>";
    }
}


?>
</body>
</html>