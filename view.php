<?php
    require "header.php";
?>

<main>
      <div class="wrapper-main">
        <section class="section-default">
          <!--
          We can choose whether or not to show ANY content on our pages depending on if we are logged in or not. I talk more about SESSION variables in the login.inc.php file!
          -->
          <?php
          $sql = "SELECT * FROM team NATURAL JOIN makes WHERE user_id=?;";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../view.php?error=sqlerror");
            exit();
          }
          else {
            mysqli_stmt_bind_param($stmt, "s", $_SESSION['id']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<a class="header-signup1">'.$row["tname"].'      ('.$row["wins"].'-'.$row["losses"].')</a>';
                echo '<br/>';
            }
          }
          ?>
        </section>
      </div>
    </main>