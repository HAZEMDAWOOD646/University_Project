<?php

include_once('inc/connections.php');
if(empty($_POST['file'])){
    $error = 'please choose photo to upload!';
    include_once('home.php');
}else{
    session_start();
}
if(isset($_SESSION['id']) && isset($_SESSION['username'])){
    $username = $_SESSION['username'];
   

if(isset($_POST['submit'])){

    $file = $_FILES['file'];
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_error = $_FILES['file']['error'];
    $file_type = $_FILES['file']['type'];
    $file_tmp = $_FILES['file']['tmp_name'];  // hello . png

    $file_ext = explode('.',$file_name);
    $file_actual_ext = strtolower(end($file_ext));
    $allowed  = array('jpg','jpge','png','svg');
    if(in_array($file_actual_ext,$allowed)){
        if($file_error === 0){ // 1000000 = 1mb
            if($file_size < 3000000){
                $file_new_name =  uniqid('',true).'.'.$file_actual_ext;
                $target = 'images/'. $file_new_name;
                $sql = "UPDATE users SET profile_picture='$file_new_name' WHERE username='$username'";
                mysqli_query($conn,$sql);
                move_uploaded_file($file_tmp,$target);
                header('location:home.php');


            }else{
                $error = 'Your photo is too big!';
                include_once('home.php');
            }

        }else{
            $error = 'Errro in upload photo!' ;
            include_once('home.php');
            
        }

    }else{
        $error = 'You cannot upload photo of this type!';
        include_once('home.php');
    }
}
}
