<?php include('./files/country.php') ?>
<?php include('./files/action.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./img/logo.png">
    <link rel="stylesheet" href="./css/signup.css">
    <title>Signup - WebCOM</title>
</head>

<body>
    <div class="container">
        <div class="container-con">
            <h1>Signup</h1>
            <?php include('./files/errors.php');?>
            <?php if(isset($success)){echo $success;} ?>
            <form action="signup.php" method="POST" enctype="multipart/form-data">
                <label>Full Name:</label>
                <input type="text" name="name" placeholder="Enter Name" autocomplete="off" ><br>
                <label>Email Address:</label>
                <input type="email" name="email" placeholder="Enter Email" autocomplete="off"><br>
                <label>Enter Password:</label>
                <input type="password" name="pass1" placeholder="Enter Password" autocomplete="off"><br>
                <label>Confirm Password:</label>
                <input type="password" name="pass2" placeholder="Confirm Password" autocomplete="off"><br>
                <label>Avatar:</label>
                <input type="file" name="img"><br>
                <button type="submit" name="signup">SignUp</button>
                <p>Already have an account? <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>
</body>

</html>