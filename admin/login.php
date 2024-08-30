<?php
include './includes/dbConnection.php';
include './includes/validation.php';
if($_SERVER['REQUEST_METHOD'] =="POST"){

    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);
    $result=$connect->query("SELECT * FROM users WHERE email='$email' AND password='$password'");
    $data=$result->fetch(PDO::FETCH_ASSOC); // id, username, email, password
    $count=$result->rowCount();
    if($count > 0){
        session_start();
        $_SESSION['user_id']=$data['id'];
        header("location: products/index.php");
    }else{
        echo "invalid email or password";
    }  
 //--------------------------------------------------------------------------------
   $errors=[];
   $email=inputValidate($_POST['email']);
   $password = $_POST['password']; 

    if(empty($email)){
        $errors['email']="email is required..";
    }else{
        if(!checkEmail($email)){
            $errors['email']="not valid email..";
        }
    }
    if(empty($password)){
        $errors['password']="password is required..";
    }else{
        if(!checkPassword($password)){
            $errors['password']="not valid password..";
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
    <title>Sign in</title>
    <link
    rel="icon"
    type="image/png"
    sizes="16x16"
    href="assets/images/favicon.png"
  />

    <!-- Font Icon -->
    <link rel="stylesheet" href="assets/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="assets/css/stylee.css">
</head>
<body>

    <div class="main">
        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="assets/images/bn-removebg-preview.png" alt="sing up image"></figure>
                        <a href="./SingUp.php" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign in</h2>
                        <form method="POST" class="register-form" id="login-form" novalidate>
                         <?php if(isset($errors)){ ?>
                           <?php if(!empty($errors)){ ?>
                            <?php } ?>
                            <?php } ?>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                                <?php if(isset($errors['email'])){ ?>
                                   <span style="color:red;display:block;text-align:left"><?php echo $errors['email'] ?></span>
                                 <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="your_pass" placeholder="Password"/>
                                <?php if(isset($errors['password'])){ ?>
                               <span style="color:red;display:block;text-align:left"><?php echo $errors['password'] ?></span>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>