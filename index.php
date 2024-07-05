<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
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
    <header>
        <img class="logo" src="images/Logo.png" alt="">
        <nav class="navigation">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Sections</a>
            <a href="#">Contact Us</a>
        </nav>
    </header>
<div class="main">

    <h1>Login</h1>
    <br>


    <form action="login.php" method="POST">
    <?php if(isset($user_error)){ echo $user_error; } ?>

    <input type="text" name="username" id="username" placeholder="username" required value="<?php if(isset($_COOKIE['username'])) echo $_COOKIE['username']; ?>"><br>

    <?php if(isset($pass_error)){ echo $pass_error; } ?>
    
    <input type="password" name="password" id="password" placeholder='password' required value="<?php if(isset($_COOKIE['password'])) echo $_COOKIE['password']; ?>"><br>

    <label> <input type="checkbox" name="keep" id="keep" value="1">Keep me signed in</label><br>

    <input style="--clr:#ffffff" type="submit" name="submit" id="submit" value='Log in'><br>
    </form>
    <div class="remember-forget">
    <a href="change-password.php">Forgot password?</a>
    </div>
    <h3>Or</h3><br>

    <a id='login' href="register.php">Register</a>
<br><br>
</div>
</body>
</html>

<?php
if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: home.php");
    die();
}
?>
