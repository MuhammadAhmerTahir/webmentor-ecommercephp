<?php include('./files/country.php') ?>
<?php include('./files/action.php') ?>

<?php 

    if(isset($_GET['unset'])){
        unset($_SESSION['admin']);
    }
    else{
        //
    }
    if(isset($_SESSION['admin'])){
        $admin = $_SESSION['admin'];
    }
    else{
        header('location: admin-login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./img/logo.png">
    <link rel="stylesheet" href="./css/admin-panel.css">
    <title>Admin-Panel - WebCOM</title>
</head>

<body>
    <div class="table">
        <div class="table-con">
            <h2>Welcome <?php echo $admin;?> <a class='msg' href="admin-panel.php?unset=1">Logout</a></h2>
            <h1>Registered Users</h1>
            <?php 
                if(isset($_POST['delete'])){
                    echo $success;
                }
            ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>RegisteredAT</th>
                    <th>UpdatedAT</th>
                    <th>Country</th>
                    <th>Delete</th>
                    <th>Update</th>
                </tr>
                <?php 
                    require './files/init.php';
                    $sql = "SELECT * from users ORDER BY id DESC";
                    $res = mysqli_query($con, $sql);
                    if(mysqli_num_rows($res) > 0){
                        while($row = mysqli_fetch_assoc($res)){
                            $id = $row['id'];
                            $img = './uploads/'.$row['img'];
                            $name= $row['name'];
                            $email = $row['email'];
                            $reg = $row['registered_at'];
                            $up = $row['updated_at'];
                            $country = $row['country'];

                            echo "
                                <tr>
                                    <td>$id</td>
                                    <td><img src='$img'></td>
                                    <td>$name</td>
                                    <td>$email</td>
                                    <td>$reg</td>
                                    <td>$up</td>
                                    <td>$country</td>
                                    <td><form action='admin-panel.php' method='post'><button type='submit' name='delete' value=$id>Delete</button></form></td>
                                    <td><form action='admin-panel.php' method='post'><button class='update' type='submit' name='update' value=$id>Update</button></form></td>
                                </tr>
                            ";
                        }
                    }
                    else{
                        echo "
                            <tr>
                                <td>NoData</td>
                                <td>NoData</td>
                                <td>NoData</td>
                                <td>NoData</td>
                                <td>NoData</td>
                                <td>NoData</td>
                            </tr>
                        ";
                    }
                ?>
            </table>
        </div>
    </div>
    
    <div class="table">
        <div class="table-con">
            <h1>Products Data</h1>
            <?php 
                if(isset($_POST['delete'])){
                    echo $success;
                }
            ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>P-Img</th>
                    <th>P-Name</th>
                    <th>P-Price</th>
                    <th>P-Delete</th>
                    <th>P-Update</th>
                </tr>
                <?php 
                    require './files/init.php';
                    $sql = "SELECT * from products ORDER BY p_id DESC";
                    $res = mysqli_query($con, $sql);
                    if(mysqli_num_rows($res) > 0){
                        while($row = mysqli_fetch_assoc($res)){
                            $id = $row['p_id'];
                            $img = './pimages/'.$row['p_img'];
                            $name= $row['p_name'];
                            $price = $row['p_price'];
                            echo "
                                <tr>
                                    <td>$id</td>
                                    <td><img src='$img'></td>
                                    <td>$name</td>
                                    <td>$price</td>
                                    <td><form action='admin-panel.php' method='post'><button type='submit' name='delete' value=$id>Delete</button></form></td>
                                    <td><form action='admin-panel.php' method='post'><button class='update' type='submit' name='update' value=$id>Update</button></form></td>
                                </tr>
                            ";
                        }
                    }
                    else{
                        echo "
                            <tr>
                                <td>NoData</td>
                                <td>NoData</td>
                                <td>NoData</td>
                                <td>NoData</td>
                                <td>NoData</td>
                                <td>NoData</td>
                            </tr>
                        ";
                    }
                ?>
            </table>
        </div>
    </div>
    

    <div class="table">
        <div class="table-con">
            <?php 
                if(isset($_POST['delete'])){
                    echo $success;
                }
            ?>
            <table>
                <tr>
                    <th>UserID</th>
                    <th>Products</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Contact</th>
                    <th>Total</th>
                    <th>Method</th>
                    <th>Change Status</th>
                </tr>
                <?php 
                    require './files/init.php';
                    $sql = "SELECT * from orders ORDER BY id DESC";
                    $res = mysqli_query($con, $sql);
                    if(mysqli_num_rows($res) > 0){
                        while($row = mysqli_fetch_assoc($res)){
                            $id= $row['id'];
                            $name= $row['name'];
                            $products = $row['products'];
                            $quantity = $row['quantity'];
                            $status = $row['status'];
                            $contact = $row['phone'];
                            $t_price = $row['total'];
                            $method = $row['method'];

                            echo "
                                <tr>
                                    <td>$name</td>
                                    <td>$products</td>
                                    <td>$quantity</td>
                                    <td class='status'>$status</td>
                                    <td>$contact</td>
                                    <td>$t_price</td>
                                    <td>$method</td>
                                    <td>
                                        <form action='admin-panel.php' method='POST'>
                                            
                                            <select name='status' onchange='form.submit()'>
                                                <option value='Pending'>Pending</option>
                                                <option value='Transporting'>Transporting</option>
                                                <option value='Completed'>Completed</option>
                                            </select>

                                            <input type='hidden' name='id' value='$id' />
                                        </form>
                                    </td>
                                
                                
                                
                                
                                    </tr>
                            ";
                        }
                    }
                    else{
                        echo "
                            <tr>
                                <td>NoData</td>
                                <td>NoData</td>
                                <td>NoData</td>
                                <td>NoData</td>
                                <td>NoData</td>
                                <td>NoData</td>
                            </tr>
                        ";
                    }
                ?>
            </table>
        </div>
    </div>


    <div class="container">
        <div class="container-con">
            <h1>Upload Products</h1>
            <?php include('./files/errors.php');?>
            <?php if(isset($_POST['success'])){echo $success;} ?>
            <form action="admin-panel.php" method="POST" enctype="multipart/form-data">
                <label>Product Name:</label>
                <input type="text" name="p_name" placeholder="Product Name" autocomplete="off" ><br>
                <label>Product Price:</label>
                <input type="text" name="p_price" placeholder="Enter Price" autocomplete="off"><br>
                <label>Product Image:</label>
                <input type="file" name="img"><br>
                <button type="submit" name="p_upload">upload</button>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="container-con">
            <?php 
                if(isset($_POST['update-data'])){
                    echo $success;
                }
            ?>
            <?php 
                if(isset($_POST['update'])){
                    require './files/init.php';
                    $id = $_POST['update'];
                    $sql = "SELECT * from users WHERE id = '$id'";
                    $res = mysqli_query($con, $sql);
                    if(mysqli_num_rows($res) > 0){
                        while($row = mysqli_fetch_assoc($res)){
                            $id = $row['id'];
                            $img = './uploads/'.$row['img'];
                            $name= $row['name'];
                            $email = $row['email'];
                            $pass = $row['pass'];
                            echo "
                                <h1>Update</h1>
                                <form action='admin-panel.php' method='POST' enctype='multipart/form-data'>
                                    <label>Full Name:</label>
                                    <input class='hidden' type='text' name='id' value=$id autocomplete='off' required ><br>
                                    <input type='text' name='name' value=$name placeholder='Enter Name' autocomplete='off' required ><br>
                                    <label>Email Address:</label>
                                    <input type='email' name='email' value=$email placeholder='Enter Email' autocomplete='off' required><br>
                                    <label>Enter Password:</label>
                                    <input type='password' name='pass' value=$pass placeholder='Enter Password' autocomplete='off' required><br>
                                    <label>Avatar:</label>
                                    <input type='file' name='img' required><br>
                                    <button type='submit' name='update-data'>Update</button>
                                </form>
                                ";
                            }
                        }
                    else{
                        echo "
                                <h1>NoData</h1>
                        ";
                    }
                }
            ?>
        </div>
    </div>

    <!-------------->
    <div class="footer">
        <p>Copyrights &copy; All Reserved. Created By M Ahmer Tahir</p>
    </div>
</body>
</html>