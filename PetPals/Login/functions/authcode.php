<?php
require '../../Dashboard/configer/dbcon.php';
require './myfunctions.php';

if(isset($_POST['reg_btn']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    if ($name == "" || $email == "" || $phone == "" || $password == "" || $cpassword == "")  
    {
        $_SESSION['message'] = "All Fields are Mandetory";
        header('Location: ../register.php');
        // exit(0);
    } 
    else 
    {
        if (!validateFullName($name)) 
        {
            $_SESSION['message'] = "Please Enter a Valid name.";
            header('Location: ../register.php');
        } 
        else 
        {
            if(preg_match('/^[^ ]+@[^ ]+\.[a-z]{2,3}$/', $email))
            {
                if(strlen($password) <= 8)
                {
                    // $_SESSION['message'] = "Password must more than 8 words";
                    header('Location: ../register.php');
                }
                // if (!preg_match('/^(?=.*[!@#$%^&*(),.?":{}|<>])(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/', $password)) 
                // {
                //      $_SESSION['message'] = "Password must be more than 8 characters, contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
                //      header('Location: ../register.php');
                // }

                else
                {
                    if(preg_match('/^98\d{8}$/', $phone ))
                    {
                        //Check email if already exist
                        $check_email_query = "SELECT email FROM users WHERE email='$email'";
                        $check_email_query_run = mysqli_query($con, $check_email_query);


                        if(mysqli_num_rows($check_email_query_run) > 0)
                        {
                            $_SESSION['message'] = "Email Already Registered";
                            header('Location: ../register.php');
                        }
                        else
                        {
                            if($password == $cpassword)
                            {
                                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                                //Insert user data
                                // $insert_query = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";
                                // $insert_query_run = mysqli_query($con, $insert_query);
                                $insert_query = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$hashed_password')";
                                $insert_query_run = mysqli_query($con, $insert_query);
                                
                                if($insert_query_run)
                                {
                                    $_SESSION['message'] = "Registration Successful";
                                    header('Location: ../login.php');
                                }
                                else
                                {
                                    $_SESSION['message'] = "Something went wrong";
                                    header('Location: ../register.php');
                                }

                            }
                            else
                            {
                                $_SESSION['message'] = "Passwords do not matched!";
                                header('Location: ../register.php');
                            }
                        }
                    }
                    else
                    {
                    $_SESSION['message'] = "Phone number must have exactly 10 digits.";
                    header('Location: ../register.php');
                    }
                }
            }
            else
            {
                $_SESSION['message'] = "Enter a Valid email address";
                header('Location: ../register.php');
            }
        }
    }
}

// if(isset($_POST['log_btn']))
// {
//     $email = mysqli_real_escape_string($con, $_POST['email']);
//     $password = mysqli_real_escape_string($con, $_POST['password']);

//     $login_query = "SELECT * FROM users WHERE email = '$email' AND password= '$password' ";
//     $login_query_run = mysqli_query($con, $login_query);

//     if(mysqli_num_rows($login_query_run) > 0)
//     {
//         $_SESSION['auth'] = true;

//         $userdata = mysqli_fetch_array($login_query_run);
//         $userid = $userdata['id'];
//         $username = $userdata['name'];
//         $useremail = $userdata['email'];
//         $role_as = $userdata['role_as'];

//         $_SESSION['name'] = $username;
//         $_SESSION['id'] = $userid;

//         $_SESSION['auth_user'] = [
//             'user_id' => $userid,
//             'name' => $username,
//             'email' => $useremail
//         ];

//         $_SESSION['role_as'] = $role_as;

//         if($role_as == 1)
//         {
//             redirect("../../Dashboard/main/admin.php", "Welcome to Dashboard");
//         }
//         else
//         {
//             redirect("../../Home/index.php", "Logged In Successfully");
//         }
//     }
//     else
//     {
//         redirect("../login.php", "Wrong Username or Password");
//     }
// }

if (isset($_POST['log_btn'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Retrieve the user record by email
    $login_query = "SELECT * FROM users WHERE email = '$email'";
    $login_query_run = mysqli_query($con, $login_query);

    if (mysqli_num_rows($login_query_run) > 0) {
        $userdata = mysqli_fetch_array($login_query_run);
        $userid = $userdata['id'];
        $username = $userdata['name'];
        $useremail = $userdata['email'];
        $phone = $userdata['phone'];
        $role_as = $userdata['role_as'];
        $stored_password = $userdata['password'];

        // Check if the stored password is hashed
        if (password_get_info($stored_password)['algo'] > 0) {
            // If hashed, verify using password_verify
            $password_valid = password_verify($password, $stored_password);
        } else {
            // If not hashed, compare directly (assuming plaintext storage)
            $password_valid = ($password === $stored_password);
        }

        if ($password_valid) {
            $_SESSION['auth'] = true;
            $_SESSION['name'] = $username;
            $_SESSION['email'] = $useremail;
            $_SESSION['id'] = $userid;
            $_SESSION['phone'] = $phone;
            $_SESSION['auth_user'] = [
                'user_id' => $userid,
                'name' => $username,
                'email' => $useremail
            ];
            $_SESSION['role_as'] = $role_as;

            if ($role_as == 1) {
                redirect("../../Dashboard/main/admin.php", "Welcome to Dashboard");
            } else {
                redirect("../../Home/index.php", "Logged In Successfully");
            }
        } else {
            redirect("../login.php", "Wrong Email or Password");
        }
    } else {
        redirect("../login.php", "Wrong Email or Password");
    }
}

if(isset($_POST['updateUserBtn']))
{   
    $user_id = $_SESSION['auth_user']['user_id'];
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $city = mysqli_real_escape_string($con, $_POST['city']);

    if ($name == "" || $phone == "" || $city == "" || $address == "")  
    {
        $_SESSION['message'] = "All Fields are Mandetory";
        header('Location: ../../User/user.php');
        // exit(0);
    } 
    else 
    {
        if (!validateFullName($name)) {
            $_SESSION['message'] = "Please Enter a Valid name.";
            header('Location: ../../User/user.php');
        }
        else 
        {

            if(preg_match('/^\d{10}$/', $phone ))
            {
                //Insert user data
                $insert_query = "UPDATE users SET name='$name', address='$address', phone='$phone', city='$city' WHERE id='$user_id'";
                $insert_query_run = mysqli_query($con, $insert_query);

                if($insert_query_run)
                {
                    $_SESSION['message'] = "Profile Updated successfully";
                    header('Location: ../../User/user.php');
                }
                else
                {
                    $_SESSION['message'] = "Something went wrong";
                    header('Location: ../../User/user.php');
                }

            }
            else
            {
                $_SESSION['message'] = "Phone number must have exactly 10 digits.";
                header('Location: ../../User/user.php');
            }
        }
    }
}
            

?>
