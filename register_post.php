<?php
include('inc/connections.php');

$err_s = 0; // Initialize error flag

if(isset($_POST['submit'])){
    // Sanitize and validate input
    $username = stripcslashes(strtolower($_POST['username']));
    $phone = stripcslashes($_POST['phone']);
    $email = stripcslashes($_POST['email']);
    $password = stripcslashes($_POST['password']);
    
    $username = htmlentities(mysqli_real_escape_string($conn, $username));
    $phone = htmlentities(mysqli_real_escape_string($conn, $phone));
    $email = htmlentities(mysqli_real_escape_string($conn, $email));
    $password = htmlentities(mysqli_real_escape_string($conn, $password));
    $md5_pass = md5($password);

    if(isset($_POST['birthday_month']) && isset($_POST['birthday_day']) && isset($_POST['birthday_year'])){
        $birthday_month = (int)$_POST['birthday_month'];
        $birthday_day = (int)$_POST['birthday_day'];
        $birthday_year = (int)$_POST['birthday_year'];
        $birthday = "$birthday_day-$birthday_month-$birthday_year"; 
    } else {
        $birthday = null;
    }

    if(isset($_POST['gender'])){
        $gender = $_POST['gender'];
        $gender = htmlentities(mysqli_real_escape_string($conn, $gender));
        if(!in_array($gender, ['male', 'female'])){
            $gender_error = '<p id="error">Please choose a valid gender!</p>';
            $err_s = 1;
        }
    } else {
        $gender_error = '<p id="error">Please choose gender!</p>';
        $err_s = 1;
    }

    if(isset($_POST['type'])){
        $type = $_POST['type'];
        $type = htmlentities(mysqli_real_escape_string($conn, $type));
        if(!in_array($type, ['user', 'admin'])){
            $type_error = '<p id="error">Please choose a valid type!</p>';
            $err_s = 1;
        }
    } else {
        $type_error = '<p id="error">Please choose type!</p>';
        $err_s = 1;
    }

    if(!preg_match('/^[0-9]{10,15}$/', $phone)) {
        $phone_error = '<p id="error">Please enter a valid phone number!</p>';
        $err_s = 1;
    }

    // Check if username already exists
    $check_user = "SELECT * FROM `users` WHERE username='$username'";
    $check_result = mysqli_query($conn, $check_user);
    $num_rows = mysqli_num_rows($check_result);
    if($num_rows != 0){
        $user_error = '<p id="error">Sorry, username already exists. Please choose another one.</p>';
        $err_s = 1;
    }

    $check_phone = "SELECT * FROM `users` WHERE phone='$phone'";
    $check_result = mysqli_query($conn, $check_phone);
    $num_rows = mysqli_num_rows($check_result);
    if($num_rows != 0){
        $phone_error = '<p id="error">Sorry, phone number already exists. Please choose another one.</p>';
        $err_s = 1;
    }

    // Validate input
    if(empty($username)) {
        $user_error = '<p id="error">Please enter username!</p>';
        $err_s = 1;
    } elseif(strlen($username) < 6 ){
        $user_error = '<p id="error">Your username needs to have a minimum of 6 letters!</p>';
        $err_s = 1;
    } elseif(filter_var($username, FILTER_VALIDATE_INT)) {
        $user_error = '<p id="error">Please enter a valid username, not a number!</p>';
        $err_s = 1;
    }

    if(empty($email)) {
        $email_error = '<p id="error">Please enter email!</p>';
        $err_s = 1;
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = '<p id="error">Please enter a valid email!</p>';
        $err_s = 1;
    }

    if(empty($birthday)){
        $birthday_error = '<p id="error">Please enter date of birth!</p>';
        $err_s = 1;
    }

    if(empty($password)){
        $pass_error = '<p id="error">Please enter password!</p>';
        $err_s = 1;
    } elseif(strlen($password) < 6){
        $pass_error = '<p id="error">Your password needs to have a minimum of 6 characters!</p>';
        $err_s = 1;
    }

    if($err_s == 0 && $num_rows == 0){
        $picture = ($gender == 'male') ? 'no-male.png' : 'no-female.png';
        $sql = "INSERT INTO users(username, phone, email, password, type, birthday, gender, profile_picture) 
                VALUES ('$username', '$phone', '$email', '$md5_pass', '$type', '$birthday', '$gender',  '$picture')";
        mysqli_query($conn, $sql);
        header('Location: index.php');
        exit();
    } else {
        include('register.php');
    }
}
?>
