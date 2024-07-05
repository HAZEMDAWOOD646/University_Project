<?php
session_start();
include_once('inc/connections.php');
if(isset($_POST['username']) && isset($_POST['password'])){
$username = stripcslashes(htmlspecialchars(strtolower($_POST['username'])));
$password = stripcslashes(htmlspecialchars($_POST['password']));
$md5_pass = md5($password);
var_dump($md5_pass);
if(isset($_POST['keep'])){
    $keep = stripcslashes(htmlspecialchars($_POST['keep']));
    if($keep ==1){
        setcookie('username',$username,time()+3600,'/');
        setcookie('password',$password,time()+3600,'/');
    }
}
if(empty($username)){
    $user_error = '<p id="error">Please insert username</p>';
    $err_s = 1;
}
if(empty($password)){
    $pass_error = '<p id="error">Please insert password</p>';
    $err_s = 1;
    include_once('index.php');
}
if(!isset($err_s)){
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$md5_pass'  limit 1";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $num_rows = mysqli_num_rows($result);
    if($num_rows != 0){
        $_SESSION['username']= $row['username'];
        $_SESSION['id']= $row['id'];
        header('Location:home.php');
        exit();

    }else{
        $user_error = '<p id="error">Worng usrname or password</p><br>';
        include_once('index.php');
        exit();
    }
}
}

