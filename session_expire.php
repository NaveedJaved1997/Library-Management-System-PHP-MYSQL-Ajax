<?php
session_start();
    //unset session
    unset($_SESSION["userid"]);
    unset($_SESSION["username"]);
    unset($_SESSION["session_time"]);
    echo "Session Cleared Successfully!";
?>