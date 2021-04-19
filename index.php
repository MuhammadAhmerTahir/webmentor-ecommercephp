<?php include('./files/country.php') ?>

<?php 
    session_start();

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



    if(isset($_POST['add-to-cart'])){
        $_SESSION['cart'][] = array(
            'id' => rand(100,10000),
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'quan' => $_POST['quan'],
            'img' => $_POST['img'],
        );
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;700&family=Poppins:wght@900&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6d5ca9b667.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="shortcut icon" href="./img/logo.png">
    <title>WebCOM - Official</title>
</head>

<body>

    <a class="cart" href="checkout.php"><i class="fas fa-shopping-cart"></i><span><?php if(isset($_SESSION['cart'])){ echo count($_SESSION['cart']); }else{ echo '0';} ?></span></a>
    
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
            <p>Available Only For You</p>
            <h1>Products</h1>
                  
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
                    $sql = "SELECT * from products ORDER By p_id DESC";
                    $res = mysqli_query($con, $sql);
                    while($row = mysqli_fetch_assoc($res)){
                        $img = './pimages/'.$row['p_img'];
                ?>
                <div class="product-box">
                    <img src="<?php echo $img;?>">
                    <h2><?php echo $row['p_name'];?></h2>
                    <h3>PKR: <span><?php echo $row['p_price'];?></span></h3>
                    <form action="index.php" method="post">
                        <input type="number" name="quan" min="1" max="5" value="1" placeholder="Quantity" required>
                        <input type="hidden" name="img" value="<?php echo $img;?>" placeholder="Name" required>
                        <input type="hidden" name="name" value="<?php echo $row['p_name'];?>" placeholder="Name" required>
                        <input type="hidden" name="price" value="<?php echo $row['p_price'];?>" placeholder="price" required>
                        <button type="submit" name="add-to-cart">Add To Cart</button>
                    </form>
                </div>
            <?php 
                }
            ?>
            </div>
        </div>
    </div>

     <!-------------->
    <div class="footer">
        <p>Copyrights &copy; All Reserved. Created By M Ahmer Tahir</p>
    </div>


</body>

</html>