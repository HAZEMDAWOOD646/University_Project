<?php

$msg = "";

include 'inc/connections.php';

if (isset($_GET['reset'])) {
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='{$_GET['reset']}'")) > 0) {
        if (isset($_POST['submit'])) {
            $password = mysqli_real_escape_string($conn, md5($_POST['password']));
            $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm-password']));

            if ($password === $confirm_password) {
                $query = mysqli_query($conn, "UPDATE users SET password='{$password}', code='' WHERE code='{$_GET['reset']}'");

                if ($query) {
                    header("Location: index.php");
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match.</div>";
            }
        }
    } else {
        $msg = "<div class='alert alert-danger'>Reset Link do not match.</div>";
    }
} else {
    header("Location: forgot-password.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel='stylesheet' href="css/main.css">
   <style>
    body {
  font-family: "Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande",
    "Lucida Sans", Arial, sans-serif;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  position: relative;
  height: 100%;
  width: 100%;
  background-image: url('images/background.png');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat; 
  height: 100vh;
  margin: 0;
}
</style>
</head>
<body>

<div class="main">
        <h1>Change Password</h1>
        <i>Enter Your New Password </i><br><br>
        <?php echo $msg; ?>

        <form action="" method="post">
            <input type="password" class="password" name="password" placeholder="Enter Your Password" required><br>
            <input type="password" class="confirm-password" name="confirm-password" placeholder="Confirm Your Password" required><br><br>
            <input style="--clr:#ffffff" type="submit" name="submit" value='Change Password'><br>
            </form>
            <div class="social-icons">
        <p>Back to! <a href="index.php">Login</a>.</p> 
    </div>
</div>
    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function (c) {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

</body>
</html>