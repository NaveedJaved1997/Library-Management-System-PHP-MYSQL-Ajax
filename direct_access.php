<?php 
if(!isset($_SESSION)) { 
   session_start(); 
 } 
 if((isset($_SESSION['userid']) && !empty($_SESSION['userid'])) || (isset($_COOKIE['user_id']))){
     echo 'Direct access not permitted';
      return;
 }
 else if((!isset($_SESSION['userid']) || empty($_SESSION['userid'])) || !isset($_COOKIE['user_id'])){
    header('location: login.php');
 }
 
 
 //old code ↓
//  if(isset($_COOKIE['user_id'])){
//    echo 'Direct access not permitted';
//     return;
// }
// else if(!isset($_COOKIE['user_id']) || empty($_COOKIE['user_id'])){
//   header('location: login.php');
// }
?>