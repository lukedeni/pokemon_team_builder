<?php

if (isset($_POST['delete'])) {

    require 'dbh.inc.php';
    $poke =$_POST['poke_id'];
    $team_id = $_POST['team_id'];
    $tname = $_POST['tname'];

    $sql = "DELETE FROM contains WHERE poke_id=? AND team_id=?";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../viewteam.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "ii", $poke, $team_id);
      mysqli_stmt_execute($stmt);

      $_SESSION['team_id'] = $team;
      $_SESSION['tname'] = $tname;

    
      header("Location: ../viewteam.php?team_id=".$team."");
        exit(); 
}
}
else {
    header("Location: ../viewteam.php?team_id=".$team_id."");
    exit();
}

?>



