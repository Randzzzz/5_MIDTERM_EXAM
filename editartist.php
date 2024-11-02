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
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/actionartist.css">
</head>

<body>
  <div class="title">
    <h1>Welcome To Music Artists Management System</h1>
  </div>
  <?php $getArtistByID = getArtistByID($pdo, $_GET['artist_id']); ?>

  <div class="form">
    <div class="items">
      <form action="core/handleForms.php?artist_id=<?php echo $_GET['artist_id']; ?>" method="POST">
        <h3>Edit the Artist!</h3>
        <p>
          <label for="firstName">First Name:</label>
          <input type="text" name="firstName" value="<?php echo $getArtistByID['first_name']; ?>">
        </p>
        <p>
          <label for="lastName">Last Name:</label>
          <input type="text" name="lastName" value="<?php echo $getArtistByID['last_name']; ?>">
        </p>
        <p>
          <label for="stageName">Stage Name:</label>
          <input type="text" name="stageName" value="<?php echo $getArtistByID['stage_name']; ?>">
        </p>
        <p>
          <label for="gender">Gender:</label>
          <input type="text" name="gender" value="<?php echo $getArtistByID['gender']; ?>">
        </p>
        <p>
          <label for="email">Email:</label>
          <input type="text" name="email" value="<?php echo $getArtistByID['email']; ?>">

          <input id="actionBtn" type="submit" name="editArtistBtn">
        </p>
      </form>
    </div>
  </div>

</body>

</html>