<?php include('./files/country.php') ?>
<?php include('./files/action.php') ?>
<?php 

    if(isset($_SESSION['username'])){
        header('location: index.php');
    }
    else{
        //
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./img/logo.png">
    <link rel="stylesheet" href="./css/login.css">
    <title>Login - WebCOM</title>
</head>

<body>
    <div class="container">
        <div class="container-con">
            <h1>Login</h1>
            <?php include('./files/errors.php');?>
            
            <form action="login.php" method="POST">
                <label>Email Address:</label>
                <input type="email" name="email" placeholder="Enter Email" autocomplete="off"><br>
                <label>Enter Password:</label>
                <input type="password" name="pass" placeholder="Enter Password" autocomplete="off"><br>
                <button type="submit" name="login">Login</button>
                <p>Don't have an account? <a href="signup.php">Signup</a></p>
            </form>
        </div>
    </div>
</body>

</html>