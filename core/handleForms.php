<?php
require_once 'models.php';
require_once 'dbConfig.php';
require_once 'validate.php';

if (isset($_POST['registerUserBtn'])) {

  $username = sanitizeInput($_POST['username']);
  $user_fname = sanitizeInput($_POST['user_fname']);
  $user_lname = sanitizeInput($_POST['user_lname']);
  $user_age = sanitizeInput($_POST['user_age']);
  $user_address = sanitizeInput($_POST['user_address']);
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  if (!empty($username) && !empty($user_fname) && !empty($user_lname) && !empty($user_age) && !empty($user_address) && !empty($password) && !empty($confirm_password)) {

    if ($password == $confirm_password) {

      if (validatePassword($password)) {

        $insertQuery = insertNewUser($pdo, $username, $user_fname, $user_lname, $user_age, $user_address, sha1($password));

        if ($insertQuery) {
          header("Location: ../login.php");
        } else {
          header("Location: ../register.php");
        }
      } else {
        $_SESSION['message'] = "Password should be more than 8 characters and should contain both uppercase, lowercase, and numbers";
        header("Location: ../register.php");
      }
    } else {
      $_SESSION['message'] = "Please check if both passwords are equal!";
      header("Location: ../register.php");
    }

  } else {
    $_SESSION['message'] = "Please make sure the input fields 
		are not empty for registration!";

    header("Location: ../register.php");
  }

}

if (isset($_POST['loginUserBtn'])) {

  $username = sanitizeInput($_POST['username']);
  $password = sha1($_POST['password']);

  if (!empty($username) && !empty($password)) {

    $loginQuery = loginUser($pdo, $username, $password);

    if ($loginQuery) {
      header("Location: ../index.php");
    } else {
      header("Location: ../login.php");
    }

  } else {
    $_SESSION['message'] = "Please make sure the input fields 
		are not empty for the login!";
    header("Location: ../login.php");
  }

}

if (isset($_POST['insertArtistBtn'])) {
  $added_by = $_SESSION['username'];
  $user_id = $_SESSION['user_id'];

  $firstName = sanitizeInput($_POST['firstName']);
  $lastName = sanitizeInput($_POST['lastName']);
  $stageName = sanitizeInput($_POST['stageName']);
  $gender = sanitizeInput($_POST['gender']);
  $email = sanitizeInput($_POST['email']);


  $query = insertArtist($pdo, $_POST['firstName'], $_POST['lastName'], $_POST['stageName'], $_POST['gender'], $_POST['email'], $added_by, $user_id);

  if ($query) {
    header("Location: ../index.php");
  } else {
    echo "Insertion failed";
  }

}

if (isset($_POST['editArtistBtn'])) {
  $last_updated_by = $_SESSION['username'];
  $user_id = $_SESSION['user_id'];

  $firstName = sanitizeInput($_POST['firstName']);
  $lastName = sanitizeInput($_POST['lastName']);
  $stageName = sanitizeInput($_POST['stageName']);
  $gender = sanitizeInput($_POST['gender']);
  $email = sanitizeInput($_POST['email']);

  $query = updateArtist($pdo, $_POST['firstName'], $_POST['lastName'], $_POST['stageName'], $_POST['gender'], $_POST['email'], $_GET['artist_id'], $last_updated_by);

  if ($query) {
    header("Location: ../index.php");
  } else {
    echo "Edit failed";
    ;
  }

}

if (isset($_POST['deleteArtistBtn'])) {
  $deleted_by = $_SESSION['username'];
  $user_id = $_SESSION['user_id'];

  $query = deleteArtist($pdo, $_GET['artist_id'], $deleted_by);

  if ($query) {
    header("Location: ../index.php");
  } else {
    echo "Deletion failed";
  }



}

if (isset($_POST['insertNewMusicBtn'])) {
  $added_by = $_SESSION['username'];
  $user_id = $_SESSION['user_id'];

  $title = sanitizeInput($_POST['title']);
  $genre = sanitizeInput($_POST['genre']);
  $countryArea = sanitizeInput($_POST['countryArea']);

  $query = insertMusic($pdo, $_POST['title'], $_POST['genre'], $_POST['dateRelease'], $_POST['countryArea'], $_GET['artist_id'], $added_by, $user_id);

  if ($query) {
    header("Location: ../viewmusics.php?artist_id=" . $_GET['artist_id']);
  } else {
    echo "Insertion failed";
  }
}

if (isset($_POST['editMusicBtn'])) {
  $last_updated_by = $_SESSION['username'];
  $user_id = $_SESSION['user_id'];

  $title = sanitizeInput($_POST['title']);
  $genre = sanitizeInput($_POST['genre']);
  $countryArea = sanitizeInput($_POST['countryArea']);

  $query = updateMusic($pdo, $_POST['title'], $_POST['genre'], $_POST['dateRelease'], $_POST['countryArea'], $_GET['music_id'], $last_updated_by);

  if ($query) {
    header("Location: ../viewmusics.php?artist_id=" . $_GET['artist_id']);
  } else {
    echo "Update failed";
  }

}

if (isset($_POST['deleteMusicBtn'])) {
  $deleted_by = $_SESSION['username'];
  $user_id = $_SESSION['user_id'];

  $query = deleteMusic($pdo, $_GET['music_id'], $deleted_by);

  if ($query) {
    header("Location: ../viewmusics.php?artist_id=" . $_GET['artist_id']);
  } else {
    echo "Deletion failed";
  }
}
?>