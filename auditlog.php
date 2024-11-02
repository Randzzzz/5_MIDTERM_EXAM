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
        <th>Action</th>
        <th>Table Name</th>
        <th>Record ID</th>
        <th>Details</th>
        <th>Timestamp</th>
      </tr>
      <?php $getAllAuditLog = getAllAuditLog($pdo); ?>
      <?php foreach ($getAllAuditLog as $row) { ?>
        <tr>
          <td><?php echo sanitizeInput($row['username']); ?></td>
          <td><?php echo sanitizeInput($row['action']); ?></td>
          <td><?php echo sanitizeInput($row['table_name']); ?></td>
          <td><?php echo sanitizeInput($row['record_id']); ?></td>
          <td><?php echo sanitizeInput($row['action_details']); ?></td>
          <td><?php echo sanitizeInput($row['action_timestamp']); ?></td>
        </tr>
      <?php } ?>
    </table>
  </div>
</body>

</html>