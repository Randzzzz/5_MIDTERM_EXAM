<?php
require_once 'core/models.php';
require_once 'core/handleForms.php';

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/header.css">
</head>

<body>
  <div class="title">
    <h1>Welcome To Music Artists Management System</h1>
  </div>
  <div class="form">
    <div class="items">
      <?php if (isset($_SESSION['username'])) { ?>
        <p>
        <h3>Lost your way? Get back on track <a id="linkref" href="index.php">here.</h3></a>
        </p>
      <?php } else { ?>
        <p><a href="login.php">Please Login</a></p>
      <?php } ?>
    </div>
  </div>

  <div class="container">
    <table>
      <tr>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Age</th>
        <th>Address</th>
        <th>Date Added</th>
      </tr>
      <?php $getAllUsers = getAllUsers($pdo); ?>
      <?php foreach ($getAllUsers as $row) { ?>
        <tr>
          <td><?php echo sanitizeInput($row['username']); ?></td>
          <td><?php echo sanitizeInput($row['user_fname']); ?></td>
          <td><?php echo sanitizeInput($row['user_lname']); ?></td>
          <td><?php echo sanitizeInput($row['user_age']); ?></td>
          <td><?php echo sanitizeInput($row['user_address']); ?></td>
          <td><?php echo sanitizeInput($row['date_added']); ?></td>
        </tr>
      <?php } ?>
    </table>
  </div>
</body>

</html>