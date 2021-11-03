<?php
require './direct_access.php';
require './connection.php';

$name = mysqli_real_escape_string($con,$_POST['name']);
$email = mysqli_real_escape_string($con,$_POST['email']);
$pass = mysqli_real_escape_string($con,$_POST['password']);
$pass = password_hash($pass, PASSWORD_DEFAULT);

//check dublicate emails
$dub = "SELECT EMAIL FROM USERS WHERE EMAIL = '".$email."' LIMIT 1";
$res = mysqli_query($con, $dub);
$tmp = mysqli_num_rows($res);
if($tmp > 0){
    echo "Already Registered";
}
else{
    $reg = "INSERT INTO USERS (NAME, EMAIL, PASSWORD) VALUES ('".$name."', '".$email."', '".$pass."')";
    $results = mysqli_query($con, $reg);
    if($results){
        echo "Success";
    }
    else{
        echo "Failed";
    }
}
?>