<?php

if (isset($_POST['delete'])) {

    require 'dbh.inc.php';
    $team_id = $_POST['team_id'];
    $tname = $_POST['tname'];

    $sql = "DELETE FROM team WHERE team_id=$team_id";
    $sql_make = "DELETE FROM makes WHERE team_id=$team_id";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../view.php?error=sqlerror");
      exit();
    }
    else {
    
      header("Location: ../view.php");
        exit(); 
}
mysqli_stmt_close($stmt);
mysqli_close($conn);
}
else {
    header("Location: ../view.php");
    exit();
}

?>



