<?php

session_start();
if (isset($_POST['addpoke'])) {

  require 'dbh.inc.php';

  $team = $_POST['team_id'];
  $poke = $_POST['poke_id'];
  $tname = $_POST['tname'];


  if (empty($team) | empty($poke)) {
    header("Location: ../addpokemon.php?error=emptyfield");
    exit();
  }
  else {

    $sql = "INSERT INTO contains (team_id, poke_id) VALUES (?, ?)";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../create.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "ii", $team, $poke);
      mysqli_stmt_execute($stmt);

      $_SESSION['team_id'] = $team;
      $_SESSION['tname'] = $tname;

    
      header("Location: ../viewteam.php?team_id=".$team."?poke_id=".$poke);
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
