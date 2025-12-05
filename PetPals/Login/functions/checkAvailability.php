<?php
include '../../Dashboard/configer/dbcon.php';

if (!empty($_POST["email"])) {
  $email = $_POST["email"];

  // Use regular expression to validate email format
     $emailPattern = "/^[^ ]+@[^ ]+\.[a-z]{2,3}$/";
  if (preg_match($emailPattern, $email)) {
     // Use prepared statement to prevent SQL injection
     $query = "SELECT * FROM users WHERE email = ?";
     $stmt = mysqli_prepare($con, $query);
     mysqli_stmt_bind_param($stmt, "s", $email);  // "s" for string parameter
     mysqli_stmt_execute($stmt);
     $result = mysqli_stmt_get_result($stmt);

     $count = mysqli_num_rows($result);
     if ($count > 0) {
        echo "<span style='color:red'>Sorry, Email already Registered.</span>";
     } else {
        echo "<span style='color:green'>Email available for Registration.</span>";
     }
  } else {
     echo "<span style='color:red'>Invalid email Format.</span>";
  }
  mysqli_stmt_close($stmt);
}

if (!empty($_POST["phone"])) {
  $phone = $_POST["phone"];

  // Use regular expression to validate phone format
  $phonePattern = '/^98\d{8}$/';
  if (preg_match($phonePattern, $phone)) {
     echo "<span style='color: green;'>Valid Phone Number Format</span>";
  } else {
     echo "<span style='color: red;'>Invalid Phone Number Format</span>";
  }
}




?>