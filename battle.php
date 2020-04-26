<link rel="stylesheet" type="text/css" href="style.css' %}">

<?php
    require "header.php";
?>

<main>
    <div class="bg-image-container" >
      <div class="wrapper-main" style="align-items: center;">
            <section class="section-default">
                <h1 style="padding-top: 50px"> Battle your Teams!</h1>
        
          <?php

            if (isset($_GET["error"])) {
                if ($_GET["error"] == "sameteams") {
                    echo '<p class="signuperror">Choose Varying Teams!</p>';
                }
                else if ($_GET["error"] == "invalid") {
                    echo '<p class="signuperror">Invalid Entry!</p>';
                }
            }
            else if (isset($_GET["battle"])) {
                if ($_GET["battle"] == "success") {
                  echo '<p class="signupsuccess">Battle successful!</p>';
                }
              }
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
            echo '
            <p>
            <form class="form-signup" action="" method="post">
                Select 2 Teams to Battle:
                <select style="width: 200px" name="Teams[]" multiple>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="'.$row["team_id"].'">'.$row["tname"].'</option>'; 
            }
            echo '</select></p>
            <input style="align-items: center; height:30px; width:200px" type="submit" name="submit" value="Battle Teams" /></form><br/>';
            if(isset($_POST["submit"])){
                if(!isset($_POST["Teams"])){
                    echo '<p class="signuperror">Choose 2 Teams!</p>';
                }
                else if(count($_POST["Teams"]) != 2){
                    echo '<p class="signuperror">Choose 2 Teams!</p>';
                }
                 else {
                    $sql11 = "SELECT team_id, tname, sum(hp) AS x 
                        FROM team NATURAL JOIN contains NATURAL JOIN pokemon1 NATURAL JOIN pokemon2 
                        WHERE team_id=? OR team_id=? GROUP BY team_id;";
                    $stmt11 = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt11, $sql11)) {
                        echo $sql11;
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt11, "ii", $_POST['Teams'][0], $_POST['Teams'][1]);
                        mysqli_stmt_execute($stmt11);
                        $result = mysqli_stmt_get_result($stmt11);
                        $winningteam = "";
                        $winningteamID = -1;
                        $maxhp = -1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            if($row["x"]> $maxhp){
                                $maxhp = $row["x"];
                                $winningteam = $row["tname"];
                                $winningteamID = $row["team_id"];
                            }
                        }
                        echo '<p class="signupsuccess">Battle successful! Winner was: '.$winningteam.'</p>';

                        $losingteamID = $_POST['Teams'][0];
                        if($_POST['Teams'][0] == $winningteamID){
                            $losingteamID = $_POST['Teams'][1];
                        }
                        // add one win to the winning team
                        $sql_winner = "UPDATE team set wins = wins + 1, total_battles = total_battles + 1 WHERE team_id = ?;";
                        $sql_loser = "UPDATE team set losses = losses + 1, total_battles = total_battles + 1 WHERE team_id = ?;";
                        $sql_battle = "INSERT INTO battle (team_id1, team_id2, winner) VALUES (?, ?, ?);";
                        $stmt_winner = mysqli_stmt_init($conn);
                        $stmt_loser = mysqli_stmt_init($conn);
                        $stmt_battle = mysqli_stmt_init($conn);



                        if (!mysqli_stmt_prepare($stmt_winner, $sql_winner)) {
                            exit();
                        } else if (!mysqli_stmt_prepare($stmt_loser, $sql_loser)) {
                            exit();
                        } else if (!mysqli_stmt_prepare($stmt_battle, $sql_battle)) {
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt_winner, "i", $winningteamID);
                            mysqli_stmt_bind_param($stmt_loser, "i", $losingteamID);
                            mysqli_stmt_bind_param($stmt_battle, "iii", $winningteamID, $losingteamID, $winningteamID);


                            mysqli_stmt_execute($stmt_winner);
                            mysqli_stmt_execute($stmt_loser);
                            mysqli_stmt_execute($stmt_battle);

                        }
                    }

                }
            }
          }
          ?>
        </section>
      </div>        
      <div>
    </main>