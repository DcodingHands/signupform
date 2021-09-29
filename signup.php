<?php
    require_once 'php/user.php';
    $user = new User();
    $username = '';
    $email = '';
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
        <h2>Sign up</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" novalidate>
            <div>
                <input type="text" value = '<?=$username;?>' name="username" placeholder="Username">
            </div>
            <div>
                <input type="email"name="email" value = '<?=$email;?>'placeholder="email">
            </div>
            <div class="form-group">
                <input type="password"value = '<?=$password;?>' name="password" id="password" placeholder="password">
                <i class="fa fa-eye" id="show" onclick="showpassword()"></i>
                <i class="fa fa-eye-slash" id="hide" onclick="showpassword()"></i>
            </div>
            <div class="form-group">
                <input type="password"value = '<?=$cpassword;?>' id="cpassword" name="cpassword" placeholder="confirm password">
                <i class="fa fa-eye" id="show1" onclick="showpassword1()"></i>
                <i class="fa fa-eye-slash" id="hide1" onclick="showpassword1()"></i>
            </div>
            <div>
                <input type="submit" name="Register" value="Register">
            </div>
            <div><a href="login.php">Already registered?</a></div>
            <div class="error"><?php $user->Register()?></div>
        </form>
    </div>
    <script src="js/main.js"></script>
    </body>
</html>