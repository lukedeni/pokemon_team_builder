<?php

session_start();
if (isset($_POST['create-submit'])) {

  require 'dbh.inc.php';

  $team = $_POST['team'];


  if (empty($team)) {
    header("Location: ../create.php?error=emptyfield");
    exit();
  }
  else {

    $sql = "INSERT INTO team (tname, wins, losses, total_battles) VALUES (?, 0, 0, 0)";
    $sql_make = "INSERT INTO makes (user_id, team_id) VALUES (?, 0, 0, 0)";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../create.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $team);
      mysqli_stmt_execute($stmt);

      $sql_getteamid = "select MAX(team_id) as max from team";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $sql_getteamid);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $row = mysqli_fetch_assoc($result);

      $sql_make = "INSERT INTO makes (user_id, team_id) VALUES (?, ?)";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql_make)) {
        header("Location: ../create.php?error=sqlerror");
        exit();
      }
      mysqli_stmt_bind_param($stmt, "ii", $_SESSION['id'],$row['max']);
      mysqli_stmt_execute($stmt);

        
      header("Location: ../create.php?create=".$_SESSION['id']);
        exit();
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  header("Location: ../create.php");
  exit();
}
