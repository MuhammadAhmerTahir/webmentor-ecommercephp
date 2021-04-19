<?php include('./files/country.php') ?>
<?php 
    session_start();

    if(isset($_GET['search'])){
        $search = $_GET['search'];
    }
    else{
        header('location: index.php');
    }

    if(isset($_GET['logout'])){
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['img']);
    }
    else{
        //
    }

    if(isset($_SESSION['username'])){
        $user = $_SESSION['username'];
        $ava = $_SESSION['img'];
    }
    else{
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;700&family=Poppins:wght@900&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6d5ca9b667.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/search.css">
    <link rel="shortcut icon" href="./img/logo.png">
    <title><?php echo $search; ?>- Search</title>
</head>

<body>

    <a class="cart" href="checkout.php"><i class="fas fa-shopping-cart"></i><span>1</span></a>
    
    <!-------------->
    <div class="nav">
        <div class="nav-con">
            <div class="nav-1">
                <a href="index.php">WebMentor<span>.com</span></a>
            </div>

            <div class="nav-2">
                <ul>
                    <a href="index.php">Home</a>
                    <a href="index.php">About</a>
                    <a href="index.php">Contact</a>
                    <a href="index.php">Service</a>
                    <a href="index.php">Products</a>
                </ul>
            </div>

            <div class="nav-3">
                <button><img src="<?php echo $ava;?>">
                    <ul class="drop-down">
                        <li><a href="profile.php">Edit Your Profile</a></li>
                        <li><a href="tracking.php">Track Order</a></li>
                        <li><a href="checkout.php">Checkout</a></li>
                        <li><a href="admin-panel.php">Admin</a></li>
                        <li class="logout"><a href="index.php?logout=1">Logout</a></li>
                    </ul>
                </button>
            </div>
        </div>
    </div>

    
    <!-------------->
    <div class="products">
        <div class="products-con">
            <p>Find your Dream Product</p>
            <h1>Search Products</h1>

            <div class="form">
                <div class="form-con">
                    <form action="search.php" method="GET">
                        <input type="text" name="search" placeholder="Search Products" autocomplete="off" required>
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>

            <div class="products-grid">
                <?php 
                    require './files/init.php';
                    $sql = "SELECT * from products WHERE p_name LIKE '%$search%'";
                    $res = mysqli_query($con, $sql);
                    while($row = mysqli_fetch_assoc($res)){
                        $img = './pimages/'.$row['p_img'];
                ?>
                <div class="product-box">
                    <img src="<?php echo $img;?>">
                    <h2><?php echo $row['p_name'];?></h2>
                    <h3>PKR: <span><?php echo $row['p_price'];?></span></h3>
                    <a href="index.php?add-to-cart=<?php echo $row['p_url'];?>">Add To Cart</a>
                </div>
            <?php 
            
                }
            ?>
            </div>
        </div>
    </div>

     <!-------------->
    <div class="footer">
        <p>Copyrights &copy; All Reserved. Created By Web Mentor</p>
    </div>


</body>

</html>