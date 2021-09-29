<?php
    require_once 'php/user.php';
    $user = new User();
    $email = '';
    $password = '';
    extract($_POST);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/d262f4cd0f.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="#" method="post">
            <div>
                <input type="email"  value="<?=$email;?>"name="email" placeholder="email">
            </div>
            <div class="form-group">
                <input type="password" id="password" value="<?=$password;?>" name="password" placeholder="password">
                <i class="fa fa-eye" id="show" onclick="showpassword()"></i>
                <i class="fa fa-eye-slash" id="hide" onclick="showpassword()"></i>
            </div>
            
            <div>
                <input type="submit" name="Login" value="Login">
            </div>
            <div><a href="signup.php">Not yet registered?</a><a href="forgotpassword.php" class="link">Forgot password</a></div>
            <div class="error"><?php $user->Login();?></div>
        </form>
    </div>
    <script src="js/main.js"></script>
</body>
</html>