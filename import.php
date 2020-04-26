<?php
  require "header.php";
?>

<style>

body {
      background-image: url('img/pokemon_background.jpg');
      height: 100%;
      background-position: center;
      background-size: 120% auto;
      }
    </style>
    <main>
      <div class="wrapper-main">
        <section class="section-default">
          <h1 style="text-align: center padding-top: 50px;">Import Team Data as CSV</h1>
          <br>
          <h4 style="text-align: center"> Please format .csv file for team as follows:</h4> 
          <p style="text-align: center">Only include one team per csv file. The first row should be the team name and each subsequent row is a Pokemon name. 
            If no pokemon is found with that name, your team will be created without that Pokemon</p>
          <form class="form-signup" method="post" enctype="multipart/form-data">
            <p>Upload CSV: <input type="file" name="file" /></p>
            <p><input type="submit" name="submit" value="Import"/></p>
            <?php
                if(isset($_POST["submit"])){
                    if($_FILES['file']['name']){
                        $filename = explode(".", $_FILES['file']['name']);
                        if($filename[1]=='csv'){
                            $handle = fopen($_FILES['file']['tmp_name'], 'r');
                            $data = fgetcsv($handle);

                            // get team name from first line and make the team name!
                            $team_name = mysqli_real_escape_string($conn, $data[0]);
                            $sql = "INSERT INTO team (tname, wins, losses, total_battles) VALUES (?, 0, 0, 0);";
                            $stmt_team = mysqli_stmt_init($conn);
                            mysqli_stmt_prepare($stmt_team, $sql);
                            mysqli_stmt_bind_param($stmt_team, "s", $team_name);
                            mysqli_stmt_execute($stmt_team);
                            
                            $sql_getteamid = "select MAX(team_id) as max from team";
                            $stmt_teamID = mysqli_stmt_init($conn);
                            mysqli_stmt_prepare($stmt_teamID, $sql_getteamid);
                            mysqli_stmt_execute($stmt_teamID);
                            $result = mysqli_stmt_get_result($stmt_teamID);
                            $row = mysqli_fetch_assoc($result);
                            $team_id = $row['max'];

                            $sql_make = "INSERT INTO makes (user_id, team_id) VALUES (?, ?)";
                            $stmt_make = mysqli_stmt_init($conn);
                            mysqli_stmt_prepare($stmt_make, $sql_make);
                            mysqli_stmt_prepare($stmt_make, $sql_make);
                            mysqli_stmt_bind_param($stmt_make, "ii", $_SESSION['id'],$team_id);
                            mysqli_stmt_execute($stmt_make);

                            while($data = fgetcsv($handle)){
                                // get the pokeID from the pname 
                                $poke_name = mysqli_real_escape_string($conn, $data[0]);
                                $sql_getpokeID = "SELECT poke_id FROM pokemon1 WHERE pname=?;";
                                $stmt_getpokeID = mysqli_stmt_init($conn);
                                mysqli_stmt_prepare($stmt_getpokeID, $sql_getpokeID);
                                mysqli_stmt_bind_param($stmt_getpokeID, "s", $poke_name);
                                mysqli_stmt_execute($stmt_getpokeID);
                                $result = mysqli_stmt_get_result($stmt_getpokeID);
                                $row = mysqli_fetch_assoc($result);
                                
                                // insert the contains table team_id and poke_id 
                                $sql_insertContains = "INSERT INTO contains (poke_id, team_id) VALUES (?, ?);";
                                $stmt_insertContains = mysqli_stmt_init($conn);
                                mysqli_stmt_prepare($stmt_insertContains, $sql_insertContains);
                                mysqli_stmt_bind_param($stmt_insertContains, "ii", $row['poke_id'], $team_id);
                                mysqli_stmt_execute($stmt_insertContains);

                            }
                            fclose($handle);
                        }
                    }
                }
            ?>
          </form>
        </section>
      </div>
    </main>


