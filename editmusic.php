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
  <div class="form">
    <div class="items">
      <h3>Edit the music!</h3>
      <?php $getMusicByID = getMusicByID($pdo, $_GET['music_id']); ?>
      <form
        action="core/handleForms.php?music_id=<?php echo $_GET['music_id']; ?>&artist_id=<?php echo $_GET['artist_id']; ?>"
        method="POST">
        <p>
          <label for="title">Title:</label>
          <input type="text" name="title" value="<?php echo $getMusicByID['title']; ?>">
        </p>
        <p>
          <label for="genre">Genre:</label>
          <input type="text" name="genre" value="<?php echo $getMusicByID['genre']; ?>">
        </p>
        <p>
          <label for="dateRelease">Date Release:</label>
          <input type="date" name="dateRelease" value="<?php echo $getMusicByID['date_release']; ?>">
        </p>
        <p>
          <label for="countryArea">Country Area:</label>
          <input type="text" name="countryArea" value="<?php echo $getMusicByID['country_area']; ?>">
          <input id="submitBtn" type="submit" name="editMusicBtn">
        </p>
        <a href="viewmusics.php?artist_id=<?php echo $_GET['artist_id']; ?>">
          Return to home</a>
      </form>
    </div>
  </div>

</body>

</html>