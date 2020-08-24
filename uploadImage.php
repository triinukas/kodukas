<?php
$valid_extensions = array('jpeg', 'jpg', 'png','JPEG', 'JPG', 'PNG' );
$path = 'upload/';
if($_FILES['customFile'])
{
    $img = $_FILES['customFile']['name'];
    $tmp = $_FILES['customFile']['tmp_name'];
    // get uploaded file's extension
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    // can upload same image using rand function
    $final_image = "_userId_".$_SESSION["userId"]."_".$img;
    // check's valid format
    if(in_array($ext, $valid_extensions)) 
    { 
        $path = $path.strtolower($final_image); 
        if(move_uploaded_file($tmp,$path)) 
        {
            // echo "<img src='$path' />";
       }
    } 
    else 
    {
        exit($_FILES['customFile']);
    }
}  
?>