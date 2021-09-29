<?php
    require_once 'php/user.php';
    $user = new User();
    $token = '';
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
        <h2>Token</h2>
        <p>Enter the token that was send to your email.</p>
        <hr>
        <form action="#" method="post">
            <div>
                <input type="text" value="<?=$token;?>" name="token" placeholder="6290">
            </div>
            <div>
                <input type="submit" name="Token" value="Login">
            </div>
            <div><a href="forgotpassword.php">Back</a></div>
            <div class="error"><?php $user->Token();?></div>
        </form>
    </div>
    
</body>
</html>