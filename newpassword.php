<?php
    require_once 'php/user.php';
    $user = new User();
    //$email = '';
    $password = '';
    $cpassword = '';
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
        <h2>Enter new password</h2>
        <form action="#" method="post">
    
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="password">
                <i class="fa fa-eye" id="show" onclick="showpassword()"></i>
                <i class="fa fa-eye-slash" id="hide" onclick="showpassword()"></i>
            </div>
            <div class="form-group">
                <input type="password" id="cpassword" name="cpassword" placeholder="confirm password">
                <i class="fa fa-eye" id="show1" onclick="showpassword1()"></i>
                <i class="fa fa-eye-slash" id="hide1" onclick="showpassword1()" ></i>
            </div>
            <div>
                <input type="submit" name="Newpassword" value="Continue">
            </div>
            <div><a href="token.php">Back</a></div>
            <div class="error"><?php $user->newpassword();?></div>
        </form>
    </div>
    <script src="js/main.js"></script>
</body>
</html>