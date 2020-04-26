<?php

error_log("hello", 0);
if (isset($_POST['delete'])) {
  error_log("inside", 0);

    require 'dbh.inc.php';
    $team_id = $_POST['team_id'];
    $tname = $_POST['tname'];

    $sql = "DELETE FROM team WHERE team_id=$team_id";
    $sql_make = "DELETE FROM makes WHERE team_id=$team_id AND user_id=user_id";
    $user_id = user_id;
    error_log(user_id, 0);

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../view.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "i", $team_id);
      mysqli_stmt_execute($stmt);

      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql_make)) {
        header("Location: ../view.php?error=sqlerror");
        exit();
      }
      mysqli_stmt_bind_param($stmt, "ii", $team_id, $user_id);
      mysqli_stmt_execute($stmt);


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



