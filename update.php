<?php
require './direct_access.php';
require "./connection.php";


if(isset($_POST["id"]) && $_POST["id"] != ''){
    $id = mysqli_real_escape_string($con,$_POST["id"] );
    $bname = mysqli_real_escape_string($con, $_POST["book_name"]);
    $aname = mysqli_real_escape_string($con, $_POST["author_name"]);
    $vol = mysqli_real_escape_string($con, $_POST["edition"]);
    $newfilename = mysqli_real_escape_string($con, $_POST["oldimage"]);
    $serialno = mysqli_real_escape_string($con, $_POST["sr"]);
    

if(isset($_FILES["imageupload2"]) && $_FILES["imageupload2"]["name"] != null){
        $image = $_FILES["imageupload2"]["name"];
        $temp = explode(".", $_FILES["imageupload2"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        copy($_FILES['imageupload2']['tmp_name'], "./Images/" .$newfilename);
    }

    
    $Query = "UPDATE books SET book_name = '".$bname."', author_name = '".$aname."',  edition = '".$vol."', image = '".$newfilename."' WHERE id = '".$id."'";
    $res = mysqli_query($con, $Query);
    if($res){

        echo "
        <td class='sr' id='".$id."'>".$serialno."</td>
        <td class='bookname'>$bname</td>
        <td class='authorname'>$aname</td>
        <td class='edition'>$vol</td>
        <td class='image'><img class='w-25' src='./Images/".$newfilename."'></td>
        <td>
            <button class='btn text-info edit_btn' data-value='".$id."'><i class='fa fa-pencil-square fa-2x' aria-hidden='true'></i></button>
            <button class='btn text-danger delete_btn' data-value='".$id."'><i class='fa fa-trash fa-2x'></i></button>

        </td>
        ";
    }
    else{
         echo "Failed To Add Book.";
    }
}
 ?>