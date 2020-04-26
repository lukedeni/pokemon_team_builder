<?php
    require "header.php";
?>


<style>
body {
      background-image: url('img/pokemon_background2.jpg');
      height: 100%;
      background-size: cover;
      background-position: center;
      }
    </style>  
<main>

      <div class="wrapper-main" style="align-items: center">
        <section class="section-default">

        <?php

        if(empty($_POST["team_id"])){
            $tname = $_SESSION["tname"];
            $team_id = $_SESSION["team_id"];
        } else {
            $tname = $_POST["tname"];
            $team_id = $_POST["team_id"];
        }
        if(isset($_POST["download_csv"])){
          ob_end_clean();
          $tname = $_POST["tname"];
          $team_id = $_POST["team_id"];
          header('Content-Type: text/csv; charset=utf-8');
          header('Content-Disposition: attachment; filename=data.csv');
          $output = fopen("php://output", "w");

          $sql_getTeamInfo = "SELECT tname, wins, losses FROM team WHERE team_id=?;";
          $stmt_getTeamInfo = mysqli_stmt_init($conn);
          mysqli_stmt_prepare($stmt_getTeamInfo, $sql_getTeamInfo);
          mysqli_stmt_bind_param($stmt_getTeamInfo, "i", $team_id);
          mysqli_stmt_execute($stmt_getTeamInfo);
          $result = mysqli_stmt_get_result($stmt_getTeamInfo);
          $row = mysqli_fetch_assoc($result);
          fputcsv($output, array("TEAM NAME", "WINS", "LOSSES"));
          fputcsv($output, $row);

          $sql_getPokeName = "SELECT pname, hp, type FROM contains NATURAL JOIN pokemon1 NATURAL JOIN pokemon2 WHERE team_id=?;";
          $stmt_getPokeName = mysqli_stmt_init($conn);
          mysqli_stmt_prepare($stmt_getPokeName, $sql_getPokeName);
          mysqli_stmt_bind_param($stmt_getPokeName, "i", $team_id);
          mysqli_stmt_execute($stmt_getPokeName);
          $result_getPokeName = mysqli_stmt_get_result($stmt_getPokeName);
          fputcsv($output, array(""));
          fputcsv($output, array("POKEMON NAME", "HP", "TYPE"));
          while($row_getPokeName = mysqli_fetch_assoc($result_getPokeName)){
            fputcsv($output, $row_getPokeName);
          }
          
          fclose($output);
          exit();

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
            <form class="form-signup" method="post" enctype="multipart/form-data">
            <input type="hidden" name="team_id" value="'.$team_id.'" />
            <input type="hidden" name="tname" value="'.$tname.'" />
            <p><input type="submit" name="download_csv" value="Download CSV"/></p>
            </form><br/>
            
            ';
            mysqli_stmt_bind_param($stmt, "i", $team_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($result)) {
                echo 
                '<div class="card">
                    <img src="'.$row["picURL"].'" alt="Avatar" style="width:10%">
                    <div class="container" style="padding: 10px;">
                        <h4><b>'.$row["pname"].'</b></h4>
                        <p>Type: '.$row["type"].'</p>
                        <p>HP: '.$row["hp"].'</p>
                        <form action="includes/delete.inc.php" method="post">
                        <input type="hidden" name="team_id" value="'.$team_id.'" />
                        <input type="hidden" name="tname" value="'.$tname.'" />
                        <input type="hidden" name="poke_id" value="'.$row["poke_id"].'" />
                        <button class = btn btn-primary my-2 my-sm-0"  type="submit" name="delete" style="padding: 10px"> Remove from Team</button> 
                        </form>
                    </div>
                </div>';
            }
          }
          ?>
        </section>
      </div>
     
    </main>
