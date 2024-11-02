<?php

require_once 'dbConfig.php';

function insertNewUser($pdo, $username, $user_fname, $user_lname, $user_age, $user_address, $password)
{

  $checkUserSql = "SELECT * FROM user_accounts WHERE username = ?";
  $checkUserSqlStmt = $pdo->prepare($checkUserSql);
  $checkUserSqlStmt->execute([$username]);

  if ($checkUserSqlStmt->rowCount() == 0) {

    $sql = "INSERT INTO user_accounts (username, user_fname, user_lname, user_age, user_address, password) VALUES(?,?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$username, $user_fname, $user_lname, $user_age, $user_address, $password]);

    if ($executeQuery) {
      $_SESSION['message'] = "User successfully inserted";
      return true;
    } else {
      $_SESSION['message'] = "An error occured from the query";
    }

  } else {
    $_SESSION['message'] = "User already exists";
  }


}

function loginUser($pdo, $username, $password)
{
  $sql = "SELECT * FROM user_accounts WHERE username=?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$username]);

  if ($stmt->rowCount() == 1) {
    $userInfoRow = $stmt->fetch();
    $userIDFromDB = $userInfoRow['user_id'];
    $usernameFromDB = $userInfoRow['username'];
    $passwordFromDB = $userInfoRow['password'];

    if ($password == $passwordFromDB) {
      $_SESSION['user_id'] = $userIDFromDB;
      $_SESSION['username'] = $usernameFromDB;
      $_SESSION['message'] = "Login successful!";
      return true;
    } else {
      $_SESSION['message'] = "Password is invalid, but user exists";
    }
  }


  if ($stmt->rowCount() == 0) {
    $_SESSION['message'] = "Username doesn't exist from the database. You may consider registration first";
  }

}

function getAllUsers($pdo)
{
  $sql = "SELECT * FROM user_accounts";
  $stmt = $pdo->prepare($sql);
  $executeQuery = $stmt->execute();

  if ($executeQuery) {
    return $stmt->fetchAll();
  }

}

function insertArtist($pdo, $first_name, $last_name, $stage_name, $gender, $email, $added_by, $user_id)
{

  $sql = "INSERT INTO artist_records (first_name, last_name, 
		stage_name, gender, email, added_by, user_id) VALUES(?,?,?,?,?,?,?)";

  $stmt = $pdo->prepare($sql);
  $executeQuery = $stmt->execute([
    $first_name,
    $last_name,
    $stage_name,
    $gender,
    $email,
    $added_by,
    $user_id
  ]);

  if ($executeQuery) {
    $record_id = $pdo->lastInsertId();
    insertAuditLog($pdo, $added_by, 'Insert', 'artist_records', $record_id, 'Added new artist');
    return true;
  }
}

function updateArtist($pdo, $first_name, $last_name, $stage_name, $gender, $email, $artist_id, $last_updated_by)
{

  $sql = "UPDATE artist_records
				SET first_name = ?,
					last_name = ?,
					stage_name = ?,
					gender = ?, 
					email = ?,
          last_updated_by = ?
				WHERE artist_id = ?
			";
  $stmt = $pdo->prepare($sql);
  $executeQuery = $stmt->execute([$first_name, $last_name, $stage_name, $gender, $email, $last_updated_by, $artist_id]);

  if ($executeQuery) {
    insertAuditLog($pdo, $last_updated_by, 'Update', 'artist_records', $artist_id, 'Update artist information');
    return true;
  }

}

function deleteArtist($pdo, $artist_id, $deleted_by)
{
  $deleteArtist = "DELETE FROM artist_records WHERE artist_id = ?";
  $deleteStmt = $pdo->prepare($deleteArtist);
  $executeDeleteQuery = $deleteStmt->execute([$artist_id]);

  if ($executeDeleteQuery) {
    $sql = "DELETE FROM artist_records WHERE artist_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$artist_id]);

    if ($executeQuery) {
      insertAuditLog($pdo, $deleted_by, 'Delete', 'artist_records', $artist_id, 'Deleted artist');
      return true;
    }

  }

}

function getAllArtist($pdo)
{
  $sql = "SELECT * FROM artist_records";
  $stmt = $pdo->prepare($sql);
  $executeQuery = $stmt->execute();

  if ($executeQuery) {
    return $stmt->fetchAll();
  }
}

function getArtistByID($pdo, $artist_id)
{
  $sql = "SELECT * FROM artist_records WHERE artist_id = ?";
  $stmt = $pdo->prepare($sql);
  $executeQuery = $stmt->execute([$artist_id]);

  if ($executeQuery) {
    return $stmt->fetch();
  }
}

function getMusicsByArtist($pdo, $artist_id)
{

  $sql = "SELECT 
				music_records.music_id AS music_id,
				music_records.title AS title,
				music_records.genre AS genre,
				music_records.date_release AS date_release,
				music_records.country_area AS country_area,
				music_records.date_added AS date_added,
        music_records.added_by AS added_by,
        music_records.last_updated_by AS last_updated_by,
        music_records.last_timestamp AS last_timestamp,
				CONCAT(artist_records.first_name,' ',artist_records.last_name) AS artist_owner
			FROM music_records
			JOIN artist_records ON music_records.artist_id = artist_records.artist_id
			WHERE music_records.artist_id = ? 
			ORDER BY music_records.music_id ASC;
			";

  $stmt = $pdo->prepare($sql);
  $executeQuery = $stmt->execute([$artist_id]);
  if ($executeQuery) {
    return $stmt->fetchAll();
  }
}

function insertMusic($pdo, $title, $genre, $date_release, $country_area, $artist_id, $added_by, $user_id)
{
  $sql = "INSERT INTO music_records (title, genre, date_release, country_area, artist_id, added_by, user_id) VALUES (?,?,?,?,?,?,?)";
  $stmt = $pdo->prepare($sql);
  $executeQuery = $stmt->execute([$title, $genre, $date_release, $country_area, $artist_id, $added_by, $user_id]);
  if ($executeQuery) {
    $record_id = $pdo->lastInsertId();
    insertAuditLog($pdo, $added_by, 'Insert', 'music_records', $record_id, 'Added new music');
    return true;
  }

}

function getMusicByID($pdo, $music_id)
{
  $sql = "SELECT 
				music_records.music_id AS music_id,
				music_records.title AS title,
				music_records.genre AS genre,
				music_records.date_release AS date_release,
				music_records.country_area AS country_area,
				music_records.date_added AS date_added,
        music_records.added_by AS added_by,
        music_records.last_updated_by AS last_updated_by,
        music_records.last_timestamp AS last_timestamp,
				CONCAT(artist_records.first_name,' ',artist_records.last_name) AS artist_owner 
			FROM music_records
			JOIN artist_records ON music_records.artist_id = artist_records.artist_id
			WHERE music_records.music_id = ? 
      ORDER BY music_records.music_id ASC";

  $stmt = $pdo->prepare($sql);
  $executeQuery = $stmt->execute([$music_id]);
  if ($executeQuery) {
    return $stmt->fetch();
  }
}

function updateMusic($pdo, $title, $genre, $date_release, $country_area, $music_id, $last_updated_by)
{
  $sql = "UPDATE music_records
			        SET title = ?,
                genre = ?,
                date_release = ?,
                country_area = ?,
                last_updated_by = ?
			WHERE music_id = ?
			";
  $stmt = $pdo->prepare($sql);
  $executeQuery = $stmt->execute([$title, $genre, $date_release, $country_area, $last_updated_by, $music_id]);

  if ($executeQuery) {
    insertAuditLog($pdo, $last_updated_by, 'Update', 'music_records', $music_id, 'Updated music information');
    return true;
  }
}

function deleteMusic($pdo, $music_id, $deleted_by)
{
  $sql = "DELETE FROM music_records WHERE music_id = ?";
  $stmt = $pdo->prepare($sql);
  $executeQuery = $stmt->execute([$music_id]);

  if ($executeQuery) {
    insertAuditLog($pdo, $deleted_by, 'Delete', 'music_records', $music_id, 'Deleted music');
    return true;
  }
}

function insertAuditLog($pdo, $username, $action, $table_name, $record_id, $action_details)
{
  $sql = "INSERT INTO audit_log (username, action, table_name, record_id, action_details) VALUES (?, ?, ?, ?, ?)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$username, $action, $table_name, $record_id, $action_details]);
}

function getAllAuditLog($pdo)
{
  $sql = "SELECT * FROM audit_log";
  $stmt = $pdo->prepare($sql);
  $executeQuery = $stmt->execute();

  if ($executeQuery) {
    return $stmt->fetchAll();
  }

}
?>