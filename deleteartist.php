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
      <h3>Are you sure you want to delete this artist?</h3>
      <h2>First Name: <?php echo sanitizeInput($getArtistByID['first_name']); ?></h2>
      <h2>Last Name: <?php echo sanitizeInput($getArtistByID['last_name']); ?></h2>
      <h2>Stage Name: <?php echo sanitizeInput($getArtistByID['stage_name']); ?></h2>
      <h2>Gender: <?php echo sanitizeInput($getArtistByID['gender']); ?></h2>
      <h2>Email: <?php echo sanitizeInput($getArtistByID['email']); ?></h2>
      <h2>Date Added: <?php echo $getArtistByID['date_added']; ?></h2>

      <form action="core/handleForms.php?artist_id=<?php echo $_GET['artist_id']; ?>" method="POST">
        <input id="actionBtn" type="submit" name="deleteArtistBtn" value="Delete">
        <a href="index.php">Return to home</a>
      </form>

    </div>
  </div>
</body>

</html>