<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2> Welcome:
            <?php
            session_start();
                if(isset($_SESSION['username'])){
                    echo $_SESSION['username'];
                    echo '<br>';
                    echo '<a href="php/logout.php">Logout</a>';
                }else{
                    echo '<a href="login.php">Login</a>';
                }
            ?>
            
        </h2>
    </div>
    
</body>
</html>