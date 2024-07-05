<?php

session_start();
if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: home.php");
    die();
}

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
include 'inc/connections.php';

$msg = "";

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $code = mysqli_real_escape_string($conn, md5(rand()));

    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
        $query = mysqli_query($conn, "UPDATE users SET code='{$code}' WHERE email='{$email}'");

        if ($query) {
            echo "<div style='display: none;'>";
            // Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'qwe890kmm@gmail.com';
                $mail->Password = 'skcgbuyucgwjzzxj';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;

                // Recipients
                $mail->setFrom('qwe890kmm@gmail.com');
                $mail->addAddress($email);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'no reply';
                $mail->Body = 'Here is the verification link <b><a href="http://localhost/loginRegister/change-password.php?reset=' . $code . '">http://localhost/loginRegister/change-password.php?reset=' . $code . '</a></b>';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            echo "</div>";
            $msg = "<div class='alert alert-info'>We've sent a verification link to your email address.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>$email - This email address was not found.</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forget Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Login Form" />
    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css" type="text/css" media="all" />
    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>
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
                    <h1>Forgot Password</h1>
                    <i style="font-size: 13px;">Please, enter your email and we will send you</i><br>
                    <?php echo $msg; ?>
                    <form action="" method="post">
                        <input type="email" class="email" name="email" placeholder="Enter Your Email" required>
                        <button style="--clr:#ffffff" name="submit" class="reset-btn" type="submit">Send Reset Link</button>
                    </form>
                    <div class="social-icons">
                        <p>Back to! <a href="index.php">Login</a>.</p>
                    </div>

        </div>
    </div>
</section>

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
