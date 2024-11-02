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
  <link rel="stylesheet" href="css/music.css">
</head>

<body>
  <div class="title">
    <h1>Welcome To Music Artists Management System</h1>
  </div>
  <div class="form">
    <div class="items">
      <?php $getArtistByID = getArtistByID($pdo, $_GET['artist_id']); ?>
      <h3>Stage Name: <?php echo $getArtistByID['stage_name']; ?></h3>
      <h3>Add New Music</h3>

      <form action="core/handleForms.php?artist_id=<?php echo $_GET['artist_id']; ?>" method="POST">
        <p>
          <label for="Title">title:</label>
          <input type="text" name="title" required>
        </p>
        <p>
          <label for="genre">Genre:</label>
          <input type="text" name="genre" required>
        </p>
        <p>
          <label for="dateRelease">Date Release:</label>
          <input type="date" name="dateRelease" required>
        </p>
        <p>
          <label for="countryArea">Country Area:</label>
          <input type="text" name="countryArea" required>
          <input id="submitBtn" type="submit" name="insertNewMusicBtn">
        </p>
      </form>
      <a href="index.php">Return to home</a>
    </div>
  </div>

  <div class="container">
    <table>
      <tr>
        <th>Music ID</th>
        <th>Title</th>
        <th>genre</th>
        <th>Date release</th>
        <th>Country Area</th>
        <th>Date Added</th>
        <th>Action</th>
        <th>Added By</th>
        <th>Last Updated By</th>
        <th>Last Timestamp</th>
      </tr>
      <?php $getMusicsByArtist = getMusicsByArtist($pdo, $_GET['artist_id']); ?>
      <?php foreach ($getMusicsByArtist as $row) { ?>
        <tr>
          <td><?php echo $row['music_id']; ?></td>
          <td><?php echo sanitizeInput($row['title']); ?></td>
          <td><?php echo sanitizeInput($row['genre']); ?></td>
          <td><?php echo $row['date_release']; ?></td>
          <td><?php echo sanitizeInput($row['country_area']); ?></td>
          <td><?php echo $row['date_added']; ?></td>
          <td>
            <a
              href="editmusic.php?music_id=<?php echo $row['music_id']; ?>&artist_id=<?php echo $_GET['artist_id']; ?>">Edit</a>
            |

            <a
              href="deletemusic.php?music_id=<?php echo $row['music_id']; ?>&artist_id=<?php echo $_GET['artist_id']; ?>">Delete</a>
          </td>
          <td><?php echo sanitizeInput($row['added_by']); ?></td>
          <td><?php echo sanitizeInput($row['last_updated_by']); ?></td>
          <td><?php echo $row['last_timestamp']; ?></td>
        </tr>
      <?php } ?>
    </table>
  </div>



</body>

</html>