<?php
    require "header.php";
?>

<main>
      <div class="wrapper-main">
        <section class="section-default">

        <?php


        if(empty($_POST["team_id"])){
            $tname = $_SESSION["tname"];
            $team_id = $_SESSION["team_id"];
        } else {
            $tname = $_POST["tname"];
            $team_id = $_POST["team_id"];
        }

          $sql = "SELECT * FROM team NATURAL JOIN contains NATURAL JOIN pokemon1 NATURAL JOIN pokemon2 WHERE team_id=?;";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("sLocation: ../view.php?error=sqlerror");
            exit();
          }
          else {
            echo '<p class="login-status">'.$tname.'</p>
            <form class="form-signup" action="addpokemon.php" method="post">
            <input type="hidden" name="team_id" value="'.$team_id.'" />
            <input type="hidden" name="tname" value="'.$tname.'" />

            <button type="submit"> Add To Team </button>
            </form><br/>
            
            ';
            mysqli_stmt_bind_param($stmt, "i", $team_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($result)) {
                echo 
                '<div class="card">
                    <img src="'.$row["picURL"].'" alt="Avatar" style="width:10%">
                    <div class="container">
                        <h4><b>'.$row["pname"].'</b></h4>
                        <p>Type: '.$row["type"].'</p>
                        <p>HP: '.$row["hp"].'</p>
                    </div>
                </div>';
            }
          }
          ?>
        </section>
      </div>
    </main>