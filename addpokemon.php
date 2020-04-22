<?php
    require "header.php";
?>

<main>
      <div class="wrapper-main">
        <section class="section-default">

          <?php
          $sql = "SELECT * FROM pokemon1 NATURAL JOIN pokemon2 WHERE poke_id NOT IN (SELECT poke_id from contains where team_id=?);";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../view.php?error=sqlerror");
            exit();
          }
          else {
            mysqli_stmt_bind_param($stmt, "i", $_POST['team_id']);
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
                        <form class="form-signup" action="includes/addpokemon.inc.php" method="post">
                        <input type="hidden" name="team_id" value="'.$_POST["team_id"].'" />
                        <input type="hidden" name="poke_id" value="'.$row["poke_id"].'" />
                        <input type="hidden" name="tname" value="'.$_POST["tname"].'" />

                        <button name="addpoke" type="submit"> Add To '.$_POST["tname"].' </button>
                        </form>
                    </div>
                </div>';
            }
          }
          ?>
        </section>
      </div>
    </main>