<?php
require './direct_access.php';
session_start();
//unset session
unset($_SESSION["userid"]);
unset($_SESSION["username"]);

//unset cookies
setcookie('user_id', '', time() - 3600, '/');
setcookie('user_email', '', time() - 3600, '/');
setcookie('user_name', '', time() - 3600, '/');
// setcookie('user_pass', '', time() - 3600, '/');
echo 'Success';

?>