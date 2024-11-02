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

      <form action="core/handleForms.php" method="POST">
        <h3>Add new artist here!</h3>
        <p>
          <label for="firstName">First Name:</label>
          <input type="text" name="firstName" required>
        </p>
        <p>
          <label for="lastName">Last Name:</label>
          <input type="text" name="lastName" required>
        </p>
        <p>
          <label for="stageName">Stage Name:</label>
          <input type="text" name="stageName" required>
        </p>
        <p>
          <label for="gender">Gender:</label>
          <input type="text" name="gender" required>
        </p>
        <p>
          <label for="email">Email:</label>
          <input type="text" name="email" required>
          <input id="insertBtn" type="submit" name="insertArtistBtn">
        </p>

        <?php if (isset($_SESSION['username'])) { ?>
          <p>Hello, <?php echo $_SESSION['username']; ?>! Need a break? Click here to <a id="linkref"
              href="core/logout.php">Logout.</a>
          </p>
        <?php } else { ?>
          <p><a href="login.php">Please Login</a></p>
        <?php } ?>

        <?php if (isset($_SESSION['username'])) { ?>
          <p>Interested in the users? View details <a id="linkref" href="viewuser.php">here.</a>
          </p>
        <?php } else { ?>
          <p><a href="login.php">Please Login</a></p>
        <?php } ?>

        <?php if (isset($_SESSION['username'])) { ?>
          <p>looking for something? view audit log <a id="linkref" href="auditlog.php">here.</a>
          </p>
        <?php } else { ?>
          <p><a href="login.php">Please Login</a></p>
        <?php } ?>

      </form>
    </div>
  </div>

  <div class="container">
    <table>
      <tr>
        <th>Artist ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Stage Name</th>
        <th>Gender</th>
        <th>Email</th>
        <th>Date Added</th>
        <th>Action</th>
        <th>Added By</th>
        <th>Last Updated By</th>
        <th>Last Timestamp</th>
      </tr>
      <?php $getAllArtist = getAllArtist($pdo); ?>
      <?php foreach ($getAllArtist as $row) { ?>
        <tr>
          <td><?php echo $row['artist_id']; ?></td>
          <td><?php echo sanitizeInput($row['first_name']); ?></td>
          <td><?php echo sanitizeInput($row['last_name']); ?></td>
          <td><?php echo sanitizeInput($row['stage_name']); ?></td>
          <td><?php echo sanitizeInput($row['gender']); ?></td>
          <td><?php echo sanitizeInput($row['email']); ?></td>
          <td><?php echo $row['date_added']; ?></td>
          <td>
            <a href="viewmusics.php?artist_id=<?php echo $row['artist_id']; ?>">View Musics</a> |
            <a href="editartist.php?artist_id=<?php echo $row['artist_id']; ?>">Edit</a> |
            <a href="deleteartist.php?artist_id=<?php echo $row['artist_id']; ?>">Delete</a>
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