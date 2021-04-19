<?php include('./files/country.php') ?>
<?php include('./files/action.php') ?>
<?php 
    if(isset($_SESSION['admin'])){
        header('location: admin-panel.php');
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
    <link rel="stylesheet" href="./css/admin-login.css">
    <title>Admin-Login - WebMentor</title>
</head>

<body>
    <div class="container">
        <div class="container-con">
            <h1>Admin Login</h1>
            <form action="admin-login.php" method="POST" enctype="multipart/form-data">
                <label>Email Address:</label>
                <input type="email" name="email" placeholder="Enter Email" autocomplete="off" required><br>
                <label>Enter Password:</label>
                <input type="password" name="pass" placeholder="Enter Password" autocomplete="off" required><br>
                <button type="submit" name="panel-login">Login</button>
            </form>
        </div>
    </div>
</body>

</html>