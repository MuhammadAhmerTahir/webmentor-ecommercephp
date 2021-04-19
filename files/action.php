<?php 

    session_start();
    //Connection With Database
    require 'init.php';


    $errors = array();
    //User Signup
    if(isset($_POST['signup'])){
        $name = htmlspecialchars(mysqli_real_escape_string($con, $_POST['name']));
        $email = htmlspecialchars(mysqli_real_escape_string($con, $_POST['email']));
        $pass = htmlspecialchars(mysqli_real_escape_string($con, $_POST['pass1']));
        $c_pass = htmlspecialchars(mysqli_real_escape_string($con, $_POST['pass2']));
        $img1 = $_FILES['img']['name'];
        
        if(empty($name)){array_push($errors, "Name is Required");}
        if(empty($email)){array_push($errors, "Email is Required");}
        if(empty($pass)){array_push($errors, "Password is Required");}
        if(empty($c_pass)){array_push($errors, "Confirm Password is Required");}
        if(empty($img1)){array_push($errors, "Image is Required");}

        if($pass != $c_pass){ array_push($errors, "Both Password Don't Match");}

        $sql2 = "SELECT * from users WHERE email = '$email'";
        $res2 = mysqli_query($con, $sql2);
        if(mysqli_num_rows($res2)){ array_push($errors, "Email Already exists");}
        
        if(count($errors) == 0){
            $pass1 = md5(md5($pass));
            $date = date("d, M Y H:i:s");
            $img = rand(10,100000)."-".$_FILES['img']['name'];
            $loc = $_FILES['img']['tmp_name'];
            $folder = './uploads/';
            $f_img = strtolower(str_replace(" ","-", $img));
            
            $json = file_get_contents('https://www.ipinfo.io/');
            $data = json_decode($json);
            $country = $data->country;

            $email = strtolower($email);
            $email = str_replace(" ", "", $email);
            if(move_uploaded_file($loc, $folder.$f_img)){
                $sql = "INSERT into users(name, email, pass, img, registered_at, country) VALUES('$name', '$email', '$pass1', '$f_img', '$date', '$country')";
                $res = mysqli_query($con, $sql);
                if($res){
                    $success = "<div class='success'><p>Account Created. Now Login</p></div>";
                }
                else{
                    //echo "Not Inserted";
                }
            }
            else{
                //echo "Image Didn't Moved";
            }
        }
    }

    //Delete User
    if(isset($_POST['delete'])){
        $del = $_POST['delete'];
        $sql = "DELETE from users WHERE id = '$del'";
        $res = mysqli_query($con, $sql);
        if($res){
            $success = "<div class='success'><p>Data Successfully Deleted</p></div>";
        }
        else{
            //echo "Not Deleted";
        }
    }

    //Update User Data
    if(isset($_POST['update-data'])){
        $id = htmlspecialchars(mysqli_real_escape_string($con, $_POST['id']));
        $name = htmlspecialchars(mysqli_real_escape_string($con, $_POST['name']));
        $email = htmlspecialchars(mysqli_real_escape_string($con, $_POST['email']));
        $pass = htmlspecialchars(mysqli_real_escape_string($con, $_POST['pass']));
        $img1 = $_FILES['img']['name'];
        
        if(empty($name)){array_push($errors, "Name is Required");}
        if(empty($email)){array_push($errors, "Email is Required");}
        if(empty($pass)){array_push($errors, "Password is Required");}
        if(empty($img1)){array_push($errors, "Image is Required");}
        
        if(count($errors) == 0){
            $pass1 = md5(md5($pass));
            $date = date("d, M Y H:i:s");
            $img = rand(10,100000)."-".$_FILES['img']['name'];
            $loc = $_FILES['img']['tmp_name'];
            $folder = './uploads/';
            $f_img = strtolower(str_replace(" ","-", $img));

            if(move_uploaded_file($loc, $folder.$f_img)){
                $sql = "UPDATE users SET name = '$name', email='$email', pass='$pass1', img='$f_img', updated_at='$date' WHERE id = '$id'";
                $res = mysqli_query($con, $sql);
                if($res){
                    $success = "<div class='success'><p>Data Successfully Updated</p></div>";
                }
                else{
                    echo "Not Inserted";
                }
            }
            else{
                echo "Image Didn't Moved";
            }
        }
    }

    
    
    
    //Admin Panel Login API
    if(isset($_POST['panel-login'])){
        $email = htmlspecialchars(mysqli_real_escape_string($con, $_POST['email']));
        $pass = htmlspecialchars(mysqli_real_escape_string($con, $_POST['pass']));
        
        if(empty($email)){array_push($errors, "Email is Required");}
        if(empty($pass)){array_push($errors, "Password is Required");}
        
        if(count($errors) == 0){
            $email1 = md5($email);
            $pass1 = md5($pass);
            if($email1 == 'b8aefde9f57eb22ed4e682314ac9a941'){
                if($pass1 == '2464b94ceb49c2115c4238f51be98d8b'){
                    $_SESSION['admin'] = 'Ahmer';
                }
                else{
                    array_push($errors, "Password is Wrong");
                }
            }
            else{
                array_push($errors, "Email is Wrong");
            }
        }
    }

    //User Login API
    if(isset($_POST['login'])){
        $email = htmlspecialchars(mysqli_real_escape_string($con, $_POST['email']));
        $pass = htmlspecialchars(mysqli_real_escape_string($con, $_POST['pass']));

        if(empty($email)){ array_push($errors, "Email is Empty");}
        if(empty($pass)){ array_push($errors, "Password is Empty");}
        $pass1 = md5(md5($pass));
        if(count($errors) == 0){
            $sql = "SELECT * from users WHERE email = '$email' AND pass = '$pass1' LIMIT 1";
            $res = mysqli_query($con, $sql);
            if(mysqli_num_rows($res) == 1){
                while($row = mysqli_fetch_assoc($res)){
                    $_SESSION['username'] = $row['name'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['img'] = './uploads/'.$row['img'];
                    $_SESSION['id'] = $row['id'];
                }
            }
            else{
                array_push($errors, "Email or Password is Wrong");
            }
        }
    }


    //User Signup
    if(isset($_POST['p_upload'])){
        $name = htmlspecialchars(mysqli_real_escape_string($con, $_POST['p_name']));
        $price = htmlspecialchars(mysqli_real_escape_string($con, $_POST['p_price']));
        $img1 = $_FILES['img']['name'];
        
        if(empty($name)){array_push($errors, "Name is Required");}
        if(empty($price)){array_push($errors, "Price is Required");}
        if(empty($img1)){array_push($errors, "Image is Required");}

        if(is_numeric($price) == true){}
        else{array_push($errors, "Price Must Be Number");}
        
        if(count($errors) == 0){

            $url = strtolower($name);
            $url = str_replace(" ", "-", $url);
            $url = rand(10, 100000)."-".$url;

            $date = date("d, M Y H:i:s");
            $img = rand(10,100000)."-".$_FILES['img']['name'];
            $loc = $_FILES['img']['tmp_name'];
            $folder = './pimages/';
            $f_img = strtolower(str_replace(" ","-", $img));

            if(move_uploaded_file($loc, $folder.$f_img)){
                $sql = "INSERT into products(p_name, p_price, p_url, p_img) VALUES('$name', '$price', '$url', '$f_img')";
                $res = mysqli_query($con, $sql);
                if($res){
                    $success = "<div class='success'><p>Product uploaded</p></div>";
                }
                else{
                    //echo "Not Inserted";
                }
            }
            else{
                //echo "Image Didn't Moved";
            }
        }
    }


    /*Checkout Code*/
    if(isset($_POST['order'])){
        $address = htmlspecialchars(mysqli_real_escape_string($con, $_POST['address']));
        $name = htmlspecialchars(mysqli_real_escape_string($con, $_POST['name']));
        $email = htmlspecialchars(mysqli_real_escape_string($con, $_POST['email']));
        $phone = htmlspecialchars(mysqli_real_escape_string($con, $_POST['phone']));
        $method = htmlspecialchars(mysqli_real_escape_string($con, $_POST['method']));
        
        if(empty($address)){array_push($errors, "Address is Required");}
        if(empty($name)){array_push($errors, "Name is Required");}
        if(empty($phone)){array_push($errors, "Phone is Required");}
        if(empty($method)){array_push($errors, "Method is Required");}
        if(isset($_SESSION['cart'])){if(count($_SESSION['cart']) == 0){array_push($errors, "Cart is Empty - Add Products");}}else{array_push($errors, "Cart is Empty");}
        
        if(count($errors) == 0){
            $date = date("d, M Y H:i:s");
            $p_total = 0;
            $products = "";
            $quant = "";
            $customer = $_SESSION['id'];
            foreach($_SESSION['cart'] as $key => $pros){
                $products .= $pros['name']. '==';
                $quant .= $pros['quan']. '==';
                $pop =  $pros['price'] * $pros['quan'];
                $p_total = $p_total + $pop;
            }
            $p_total2 = number_format($p_total,2);
            
            $sql = "INSERT into orders(name, email, address, total, method, quantity, customer, phone, date, products) 
            VALUES('$name', '$email', '$address', '$p_total2', '$method', '$quant', '$customer', '$phone', '$date', '$products')";
            $res = mysqli_query($con, $sql);
            if($res){
                 $success = "<div class='success'><p>Order Successfully Placed</p></div>";
            }
            else{
                array_push($errors, "Order Failed to Place - These is a problem from our End");;
            }
        }     
    }



    if(isset($_POST['status'])){
        $status = htmlspecialchars(mysqli_real_escape_string($con, $_POST['status']));
        $id= htmlspecialchars(mysqli_real_escape_string($con, $_POST['id']));
        $sql = "UPDATE orders SET status = '$status' WHERE id = '$id'";
        $res = mysqli_query($con, $sql);
        if($res){
                $success = "<div class='success'><p>Status Successfully changed</p></div>";
        }
        else{
            array_push($errors, "Order Failed to Place - These is a problem from our End");;
        }
    }     
?>