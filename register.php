<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link rel="stylesheet" href="css/main.css" />
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
      <h1>Register</h1>

      <form action="register_post.php" method="POST">
        <?php if(isset($user_error)) echo $user_error; ?>

        <?php if(isset($type_error)) echo $type_error; ?>
        <select name="type" title="type choose user or admin">
          <option disabled selected value="">Type</option>
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select>
        <br />

        <input
          type="text"
          name="username"
          id="username"
          autocapitalize="off"
          placeholder="Username"
          required
        /><br />

        <?php if(isset($phone_error)) echo $phone_error; ?>
        <input
          type="tel"
          name="phone"
          id="phone"
          placeholder="Phone number"
          required
        /><br />

        <?php if(isset($gender_error)) echo $gender_error; ?>
        <select class="gender" name="gender" title="gender choose male or female">
          <option disabled selected value="">Gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
        <br />

        <?php if(isset($email_error)) echo $email_error; ?>
        <input
          type="email"
          name="email"
          id="email"
          placeholder="Email"
          required
        /><br />

        <?php if(isset($pass_error)) echo $pass_error; ?>
        <input
          type="password"
          name="password"
          id="password"
          placeholder="Password"
          required
        /><br />
        <input type="password" class="confirm-password" name="confirm-password" id="confirm-password" placeholder="Confirm Your Password" required/><br />

        <h3 class="birth">Birthday</h3>
        <br>
        <?php if(isset($birthday_error)) echo $birthday_error; ?>
        <select aria-label="Month" name="birthday_month" id="month" title="Month" class="_9407 _5dba _9hk6 _8esg">
          <option disabled selected>Month</option>
          <option value="1">Jan</option>
          <option value="2">Feb</option>
          <option value="3">Mar</option>
          <option value="4">Apr</option>
          <option value="5">May</option>
          <option value="6">Jun</option>
          <option value="7">Jul</option>
          <option value="8">Aug</option>
          <option value="9">Sep</option>
          <option value="10">Oct</option>
          <option value="11">Nov</option>
          <option value="12">Dec</option>
        </select>
        <select aria-label="Day" name="birthday_day" id="day" title="Day" class="_9407 _5dba _9hk6 _8esg">
          <option disabled selected>Day</option>
          <?php for ($i = 1; $i <= 31; $i++): ?>
            <option value="<?= $i ?>"><?= $i ?></option>
          <?php endfor; ?>
        </select>
        <select aria-label="Year" name="birthday_year" id="year" title="Year" class="_9407 _5dba _9hk6 _8esg">
          <option disabled selected>Year</option>
          <?php for ($i = date("Y"); $i >= 1905; $i--): ?>
            <option value="<?= $i ?>"><?= $i ?></option>
          <?php endfor; ?>
        </select>
        <br />

        <input style="--clr:#ffffff" class="register" type="submit" name="submit" id="submit" value="Register" /><br />
      </form>
      <h3>Or</h3>
      <br />
      <a id="login" href="index.php">Log in</a>
    </div>
  </body>
</html>
