<?php
session_start();
require './direct_access.php';
require './connection.php';
$uid = '';
if(isset($_SESSION['userid'])){
    $uid = $_SESSION['userid'];
}
else if(isset($_COOKIE['user_id'])){
    $uid = $_COOKIE['user_id'];
}

$select = "SELECT * FROM BOOKS WHERE user_id = '".$uid."'";
    $res = mysqli_query($con, $select);
    if($res){
        $sr=1;
        while($row = mysqli_fetch_assoc($res)){
            echo " <tr  id='row".$row['id']."'><td class='sr'>". $sr. "</td>
            <td class='bookname'>".$row["book_name"]."</td>
            <td class='authorname'>".$row["author_name"]."</td>
            <td class='edition'>".$row["edition"]."</td>";
            echo '<td class="image"><img data-img="'.$row["image"].'" class="w-25" src="./Images/'.$row["image"].'" alt=""></td>
            <td>
            <button class="btn text-info edit_btn" data-value="'.$row["id"].'"><i class="fa fa-pencil-square fa-2x" aria-hidden="true"></i></button>
            <button class="btn text-danger delete_btn" data-value="'.$row["id"].'"><i class="fa fa-trash fa-2x"></i></button>

        </td></tr>';
        $sr++;    
    }
    }
?>


