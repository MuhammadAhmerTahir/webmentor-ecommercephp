<?php 

    $data = file_get_contents("http://www.ipinfo.io/");
    $json = json_decode($data);
    $country = $json->country;

    if($country == "PK"){
        //
    }
    else{
        header('location: not-in-country.php');
    }


?>