<?php
// require './direct_access.php';
$server = "localhost";
$userName = "root";
$userPass = "";
$dbName = "lms";
$con = mysqli_connect($server, $userName, $userPass, $dbName);
if(!$con){
    echo "Failed To Connect TO DB...!";
}

?>