<?php
    require './direct_access.php';
    require './connection.php';
    if(isset($_POST['deleteid']) && $_POST['deleteid']!= ''){
        $deleteId = $_POST['deleteid'];
        
        $Delete = "DELETE FROM BOOKS WHERE id = $deleteId";
        if(mysqli_query($con, $Delete)){
            echo "Success";
        }
        else{
            echo "Error Ouucred";
        }
    }
    ?>