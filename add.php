<?php
require './direct_access.php';
require "./connection.php";

$bname =  mysqli_real_escape_string($con,$_POST['book_name']);
$aname = mysqli_real_escape_string($con,$_POST['author_name']);
$vol =  mysqli_real_escape_string($con,$_POST['edition']);
$userid = mysqli_real_escape_string($con, $_POST['user_id']);
$serialno = mysqli_real_escape_string($con, $_POST["sr"]);
// $image = $_FILES['imageupload']; 
$newfilename = '';
if(isset($_FILES["imageupload"]) && $_FILES["imageupload"]["name"] != null){
    $image = $_FILES["imageupload"]["name"];
    $temp = explode(".", $_FILES["imageupload"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    copy($_FILES['imageupload']['tmp_name'], "./Images/" .$newfilename);
}

if(!empty($bname) && !empty($aname) && !empty($vol)){
    $Query = "INSERT INTO books (book_name, author_name, edition, user_id, image) VALUES ('$bname', '$aname', '$vol', '$userid','$newfilename')";
    $res = mysqli_query($con, $Query);
    if($res){

        $Query1 = "SELECT * FROM BOOKS WHERE  BOOK_NAME = '".$bname."' AND AUTHOR_NAME = '".$aname."' AND EDITION = '".$vol."' ORDER BY ID DESC LIMIT 1";
        $res1 = mysqli_query($con, $Query1);
        
        if($res1){
            // echo "test";
            $row1 = mysqli_fetch_assoc($res1);
            echo "<tr>
            <td class='sr' id='".$row1["id"]."'>".$serialno."</td>
            <td class='bookname'>$bname</td>
            <td class='authorname'>$aname</td>
            <td class='edition'>$vol</td>
            <td class='imag'><img class='w-25' src='./Images/".$row1['image']."'></td>
            <td>
                <button class='btn text-info edit_btn' data-value='".$row1["id"]."'><i class='fa fa-pencil-square fa-2x' aria-hidden='true'></i></button>
                <button class='btn text-danger delete_btn' data-value='".$row1["id"]."'><i class='fa fa-trash fa-2x' aria-hidden='true'></i></button>
            </td></tr>";
        }

    }
    else{
        echo '<div class="col-md-6 offset-md-3 mt-2 alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error! </strong><p>"'.$bname.'" Has not Been Added.</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
       </button>
        </div>';
    }
}
else{
    echo 'Please Fill The Feilds';
}

?>