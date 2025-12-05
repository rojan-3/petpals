<?php
session_start();
if (isset($_SESSION['auth'])) {
   header('Location: ../Home/Index.php');
   exit();
}
?>
<html>

<head>
   <title>PetPals</title>
   <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
   <link rel="stylesheet" href="register.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css? family=kaushan+script|popping&display=swap" rel="stylesheet" />
</head>

<body>

   <div id="banner" class="background">

      <div class="navbar">
      <a href="../Home/Index.php"><img src="./Images/logo2.png" class="logo"></a>

         <!-- <a href="../Home/Index.php"><img src="./Images/logo.png" class="logo"></a> -->
         <ul>
            <li><a href="../Home/Index.php">HOME</a></li>
            <li><a href="../Blog/Blog.php">BLOG</a></li>
            <li><a href="../Products/product.php">PRODUCTS</a></li>
            <li><a href="../Contact/Contact.php">CONTACT</a></li>
            <li><a class="active" onclick="toggleMenu()"><i class="fa fa-user"></i></a>&nbsp;</li>
         </ul>
         <!-- <img src="Images/profile.png" class="user-pic" onclick="toggleMenu()"> -->
         <div class="sub-menu-wrap" id="subMenu">
            <div class="sub-menu">
               <div class="user-info">
                  <!-- <img src="./Images/Novelty.png" alt="Image"> -->
                  <h3>Hello Guest</h3>
               </div>
               <hr>
               <a href="../User/user.php" class="sub-menu-link">
                  <img src="Images/profile.png">
                  <p>Manage Profile</p>
                  <span><i class="bx bx-chevron-right data"></i></span>
               </a>
               <a href="../Cart/Cart.php" class="sub-menu-link">
                  <img src="Images/cart.png">
                  <p>Cart</p>
                  <span><i class="bx bx-chevron-right data"></i></span>
               </a>
               <a href="../Cart/my-orders.php" class="sub-menu-link">
                  <img src="Images/order3.png">
                  <p>Track my Order</p>
                  <span><i class="bx bx-chevron-right data"></i></span>
               </a>
               <?php
               if (isset($_SESSION['auth'])) {
                  ?>
                  <a href="../Login/logout.php" class="sub-menu-link">
                     <img src="Images/logout.png">
                     <p>Logout</p>
                     <span><i class="bx bx-chevron-right data"></i></span>
                  </a>
                  <?php
               } else {
                  ?>
                  <a href="../Login/login.php" class="sub-menu-link">
                     <img src="Images/login.png">
                     <p>Login</p>
                     <span><i class="bx bx-chevron-right data"></i></span>
                  </a>
                  <?php
               }
               ?>

            </div>
         </div>

      </div>
      <div class="card-body">
         <form action="functions/authcode.php" method="POST">
            <h2>Sign Up</h2>
            <div class="form-group">
               <label for="username">Name</label>
               <input type="text" id="username" name="name" required>
            </div>
            <div class="form-group">
               <label for="phone">Phone</label>
               <input type="number" id="phone" name="phone" onInput="checkPhone()" required>
               <span id="check-phone"></span>
            </div>
            <div class="form-group">
               <label for="email">Email</label>
               <input type="email" id="email" name="email" onInput="checkEmail()" required>
               <span id="check-email"></span>
            </div>
            <!-- <div class="form-group">
               <label for="password">Password</label>
               <input type="password" id="password" class="validation-message" onInput="checkPassword()"
                  name="password">
               <span id="check-password"></span>
            </div> -->
            <div class="form-group">
               <label for="password">Password</label>
               <input type="password" id="password" name="password" oninput="validatePassword()" required>
               <span id="password-validation-message"></span>
            </div>

            <div class="form-group">
               <label for="confirm_password">Confirm Password</label>
               <input type="password" id="confirm_password" name="cpassword" required>
            </div>


            <?php if (isset($_SESSION['message'])) { ?>
               <?= $_SESSION['message']; ?>
               <?php
               unset($_SESSION['message']);
            } ?>


            <button type="submit" id="submit" name="reg_btn" class="btn">Register</button>
         </form>

         <p class="switch-text">Already have an account? <a href="../Login/login.php">Sign in</a></p>

      </div>


      <script>
         let subMenu = document.getElementById("subMenu");

         function toggleMenu() {
            console.log("Function called");
            subMenu.classList.toggle("open-menu");
         }
      </script>

      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script>
         function checkEmail() {
            var email = $("#email").val();
            var emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

            if (emailPattern.test(email)) {
               jQuery.ajax({
                  url: "./functions/checkAvailability.php",
                  data: 'email=' + email,
                  type: "POST",
                  success: function (data) {
                     $("#check-email").html(data);
                     if (data.includes("available")) {
                        $('#submit').prop('disabled', false);
                     } else {
                        $('#submit').prop('disabled', true);
                     }
                  },
                  error: function () { }
               });
            } else {
               $("#check-email").html("Invalid Email Format");
               $('#submit').prop('disabled', true);
            }
         }

         $(document).ready(function () {
            $("#email").blur(function () {
               $("#check-email").html("");
            });
         });
      </script>

      <script>
         function validatePassword() {
         const password = document.getElementById("password").value;
         const messageElement = document.getElementById("password-validation-message");
         const criteria = [
            { regex: /.{8,}/, message: "At least 8 characters" },
            { regex: /[A-Z]/, message: "At least one uppercase letter" },
            { regex: /[a-z]/, message: "At least one lowercase letter" },
            { regex: /\d/, message: "At least one number" },
            { regex: /[!@#$%^&*(),.?":{}|<>]/, message: "At least one special character" },
         ];

         // Generate feedback based on criteria
         const feedback = criteria
            .filter(criterion => !criterion.regex.test(password))
            .map(criterion => criterion.message)
            .join(", ");

         // Display validation feedback or success message
         if (feedback.length > 0) {
            messageElement.innerHTML = `Password must include: ${feedback}`;
            messageElement.style.color = "red";
         } else {
            messageElement.innerHTML = "Password is valid!";
            messageElement.style.color = "green";
         }
      }

   </script>
      <!-- 
          <script>
             function checkPhone() {
              var phone = $("#phone").val();
   var phonePattern = /^98\d{8}$/;

   if (phonePattern.test(phone)) {
      $("#check-phone").html("Valid Phone Number Format");
      $('#submit').prop('disabled', false);
   } else {
      $("#check-phone").html("Invalid Phone Number Format");
      $('#submit').prop('disabled', true);
   }
}

$(document).ready(function() {
   $("#phone").blur(function() {
      $("#check-phone").html("");
   });
});

$(document).ready(function() {
   $("#phone").blur(function() {
      $("#check-phone").html("");
   }); });
          </script> -->

      <!-- <script>
function checkPassword() {
   var password = $("#password").val();

   if (password.length >= 8) {
      $("#check-password").html("Password is valid");
      $('#submit').prop('disabled', false);
   } else {
      $("#check-password").html("Password should be at least 8 characters long");
      $('#submit').prop('disabled', true);
   }
}

$(document).ready(function() {
   $("#password").blur(function() {
      $("#check-password").html("");
   });
});

          </script> -->

</body>

</html>