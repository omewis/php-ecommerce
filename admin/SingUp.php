<?php
include './includes/validation.php';
include './includes/dbConnection.php'; // Assuming you have a database connection script

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $errors = [];
    $fullname = inputValidate($_POST['fullname']);
    $phone=inputValidate($_POST['phone']);
    $email = inputValidate($_POST['email']);
    $password = $_POST['password'];
    $conf_pass = $_POST['conf_pass'];

    // Validate the input fields
    if (empty($fullname)) {
        $errors['fullname'] = "Username is required.";
    } elseif (!checkAlpha($fullname)) {
        $errors['fullname'] = "Not a valid username.";
    }
    
    if(empty($phone)){
        $errors['phone']="phone is required..";
    }else{
        if(!checkPhone($phone)){
            $errors['phone']="not valid phonenumber..";
        }
    }

    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!checkEmail($email)) {
        $errors['email'] = "Not a valid email.";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required.";
    } elseif (!checkPassword($password)) {
        $errors['password'] = "Not a valid password.";
    }

    if (empty($conf_pass)) {
        $errors['conf_pass'] = "Confirm password is required.";
    } elseif ($password !== $conf_pass) {
        $errors['conf_pass'] = "Passwords do not match.";
    }

    // If there are no validation errors, proceed
    if (empty($errors)) {
        // Hash the password using md5
        $hashed_password = md5($password);

        // Insert into the database
        $insert_result = $connect->query("INSERT INTO `users` (`user_name`, `email`, `password`,`phone`) VALUES ('$fullname', '$email', '$hashed_password','$phone')");

        if ($insert_result) {
            // Redirect to the login page upon successful registration
            header('Location: login.php');
            exit();
        } else {
            $errors['database'] = "Failed to insert user data.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png"/>
    <link rel="stylesheet" href="assets/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="assets/css/stylee.css">
</head>
<body>
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Sign up</h2>
                    <form method="POST" class="register-form" id="register-form" novalidate>
                    <?php if(isset($errors)){ ?>
                           <?php if(!empty($errors)){ ?>
                            <?php } ?>
                            <?php } ?>
                        <div class="form-group">
                            <label for="fullname"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="fullname" id="name" placeholder="User name"/>
                            <?php if(isset($errors['fullname'])){ ?>
                           <span style="color:red;display:block;text-align:left"><?php echo $errors['fullname'] ?></span>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="phone"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="phone" id="phone" placeholder="phone"/>
                            <?php if(isset($errors['phone'])){ ?>
                            <span style="color:red;display:block;text-align:left"><?php echo $errors['phone'] ?></span>
                           <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Your Email"/>
                            <?php if(isset($errors['email'])){ ?>
                                   <span style="color:red;display:block;text-align:left"><?php echo $errors['email'] ?></span>
                                 <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="pass" placeholder="Password"/>
                            <?php if(isset($errors['password'])){ ?>
                               <span style="color:red;display:block;text-align:left"><?php echo $errors['password'] ?></span>
                                <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="conf_pass" id="re_pass" placeholder="Repeat your password"/>
                            <?php if(isset($errors['conf_pass'])){ ?>
                          <span style="color:red;display:block;text-align:left"><?php echo $errors['conf_pass'] ?></span>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="assets/images/bn-removebg-preview.png" alt="sing up image"></figure>
                    <a href="login.php" class="signup-image-link">I am already a member</a>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
</body>
</html>