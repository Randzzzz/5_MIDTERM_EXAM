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
  <link rel="stylesheet" href="css/actionmusic.css">
</head>


<body>
  <div class="title">
    <h1>Welcome To Music Artists Management System</h1>
  </div>
  <?php $getMusicByID = getMusicByID($pdo, $_GET['music_id']); ?>

  <div class="form">
    <div class="items">
      <h3>Are you sure you want to delete this music?</h3>
      <h3>Title: <?php echo sanitizeInput($getMusicByID['title']); ?></h3>
      <h3>Genre: <?php echo sanitizeInput($getMusicByID['genre']); ?></h3>
      <h3>Date Release: <?php echo $getMusicByID['date_release'] ?></h3>
      <h3>Country Area: <?php echo sanitizeInput($getMusicByID['country_area']); ?></h3>


      <form
        action="core/handleForms.php?music_id=<?php echo $_GET['music_id']; ?>&artist_id=<?php echo $_GET['artist_id']; ?>"
        method="POST">
        <input id="submitBtn" type="submit" name="deleteMusicBtn" value="Delete">
        <a href="viewmusics.php?artist_id=<?php echo $_GET['artist_id']; ?>">
          Return to home</a>
      </form>


    </div>
  </div>


  </div>
</body>

</html>