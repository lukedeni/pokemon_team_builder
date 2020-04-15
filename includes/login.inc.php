<?php
if (isset($_POST['login-submit'])) {

  require 'dbh.inc.php';

  $mailuid = $_POST['mailuid'];
  $password = $_POST['pwd'];


  if (empty($mailuid) || empty($password)) {
    header("Location: ../index.php?error=emptyfields&mailuid=".$mailuid);
    exit();
  }
  else {

    $sql = "SELECT * FROM user1 NATURAL JOIN user2 WHERE name=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../index.php?error=sqlerror");
      exit();
    }
    else {


      mysqli_stmt_bind_param($stmt, "s", $mailuid);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if ($row = mysqli_fetch_assoc($result)) {
        $pwdCheck = password_verify($password, $row['password']);
        if ($pwdCheck == false) {
          header("Location: ../index.php?error=wrongpwd");
          exit();
        }
        else if ($pwdCheck == true) {
          session_start();
          $_SESSION['id'] = $row['user_id'];
          $_SESSION['uid'] = $row['name'];
          $_SESSION['email'] = $row['email'];
          header("Location: ../index.php?login=".$_SESSION['id']);
          exit();
        }
      }
      else {
        header("Location: ../index.php?login=wronguidpwd");
        exit();
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  header("Location: ../signup.php");
  exit();
}
