<?php
require './direct_access.php';
require './connection.php';

$uid = '';
if(isset($_SESSION['userid'])){
    $uid = $_SESSION['userid'];
}
else if(isset($_COOKIE['user_id'])){
    $uid = $_COOKIE['user_id'];
}

$select = "SELECT * FROM USERS WHERE id = '".$uid."'";
    $res = mysqli_query($con, $select);
    if($res){

        while($row = mysqli_fetch_assoc($res)){
            // echo " <tr>
            // <input  type='hidden' id='user_id".$row['id']."'>". $row['id']."/>
            // <input class='form-control m-1' type='text' id='user_name'>".$row["name"]."/>
            // <input class='form-control m-1' type='email' id='user_email'>".$row["email"]."/>
            // <input class='form-control m-1' type='password' id='user_pass'>".$row["password"]."/>";
            // echo '<input class="btn btn-outline-primary m-1 float-right" type="submit" value="Save Changes" id="update_profile_btn" name="update_profile_btn">';

            echo '<input type="hidden" name="user_id" id="user_id" value="'.$row["id"].'">
            <input class="form-control m-1" type="text" name="user_name" id="user_name" value="'.$row["name"].'">
            <input class="form-control m-1" type="email" name="user_email" id="user_email" value="'.$row["email"].'">
            <input class="btn btn-outline-primary m-1 float-right" type="submit" value="Save Changes" id="update_profile_btn" name="update_profile_btn">';
    }
    }
?>