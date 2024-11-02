<?php
require_once 'core/models.php';
require_once 'core/handleForms.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/login_reg.css">
  <link rel="stylesheet" href="css/header.css">
</head>

<body>
  <div class="title">
    <h1>Music Artists Management System</h1>
  </div>
  <div class="form">
    <div class="items">


      <h1>Register here!</h1>
      <?php if (isset($_SESSION['message'])) { ?>
        <h5 style="color: red;"><?php echo $_SESSION['message']; ?></h5>
      <?php }
      unset($_SESSION['message']); ?>
      <form action="core/handleForms.php" method="POST">
        <p>
          <label for="username">Username:</label>
          <input type="text" name="username" required>
        </p>
        <p>
          <label for="user_fname">First Name:</label>
          <input type="text" name="user_fname" required>
        </p>
        <p>
          <label for="user_lname">Last Name:</label>
          <input type="text" name="user_lname" required>
        </p>
        <p>
          <label for="user_age">Age:</label>
          <input type="number" name="user_age" required>
        </p>
        <p>
          <label for="user_address">Address:</label>
          <input type="text" name="user_address" required>
        </p>
        <p>
          <label for="password">Password:</label>
          <input type="password" name="password" required>
        </p>
        <p>
          <label for="confirm_password">Confirm Password:</label>
          <input type="password" name="confirm_password" required>
          <input id="submitBtn" type="submit" name="registerUserBtn">
        </p>
        <p>Already have an account? You may login <a id="linkref" href="login.php">here.</a></p>
      </form>
    </div>
  </div>

</body>

</html>