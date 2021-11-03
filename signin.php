<?php
session_start();
date_default_timezone_set("Asia/Karachi");
// $lifespan = 30;
// ini_set('session.gc_maxlifetime', $lifespan);

require './direct_access.php';
require './connection.php';

$email = mysqli_real_escape_string($con,$_POST['email']);
$pass = mysqli_real_escape_string($con,$_POST['password']);

$find = "SELECT * FROM USERS WHERE EMAIL = '".$email."'";
$res = mysqli_query($con, $find);

$row = mysqli_fetch_assoc($res);
// echo $_POST['remember'];
if(isset($_POST['remember']) && $_POST['remember'] == 'true'){
    if(!isset($_COOKIE["user_id"])){
    //Set Cookies
    $cookie_id = "user_id";
    $cookie_value = $row['id'];
    setcookie($cookie_id, $cookie_value, time() + (86400 * 30), "/");
    setcookie('user_email', $row['email'], time() + (86400 * 30), "/");
    setcookie('user_name', $row['name'], time() + (86400 * 30), "/");
    // setcookie('user_pass', $pass, time() + (86400 * 30), "/");
    }
    }
    else{
        setcookie('user_id','');
        setcookie('user_email','');
        // $cookie_id = "user_id";
        // $cookie_value = $row['id'];
        // setcookie($cookie_id, $cookie_value, time() + (60), "/");
        // setcookie('user_email', $row['email'], time() + (60), "/");
        // setcookie('user_pass', $pass, time() + (86400), "/");
    }

if(mysqli_num_rows($res)==1){
    $hash = $row['password'];
    $verify = password_verify($pass, $hash);
    if($verify){
        //Set Session
        $_SESSION['username'] = $row['name'];
        $_SESSION['userid'] = $row['id'];
        $_SESSION["session_time"] = time();

        echo "Success";

    }
    else{
        echo "Warning";
    }
}
else{   
    echo "Danger";
}

?>