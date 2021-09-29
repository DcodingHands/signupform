<?php
    require_once 'php/user.php';
    $user = new User();
    $email = '';
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
        <h2>Forgot password</h2>
        <p>To reset your password enter a vaild email address!</p>
        <hr>
        <form action="#" method="post">
            <div>
                <input type="email" value="<?=$email;?>" name="email" placeholder="email">
            </div>
            <div>
                <input type="submit" name="Forgotpassword" value="Login">
            </div>
            <div><a href="login.php">Back</a></div>
            <div class="error"><?php $user->forgotpassword();?></div>
        </form>
    </div>
    
</body>
</html>