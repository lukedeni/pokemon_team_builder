<?php
require "header.php";
?>


<main>
    <div class="wrapper-main">
    <section class="section-default">
        <?php
        if (isset($_POST['search-submit'])) {
            $query = $_POST['search_query'];
            echo '<h2> Search results for: '; echo $query; 
                $stmt = mysqli_stmt_init($conn);
                $team_sql = "SELECT * FROM team WHERE tname LIKE CONCAT('%', ?, '%')";
                $poke_sql = "SELECT * FROM pokemon2 WHERE pname LIKE CONCAT('%', ?, '%')";
    
                echo '<p style="margin-top: 10px; font-size: 16px !important; font-weight: normal !important"> Advanced criteria: <br />
                    <ul style="margin-left: 20px; font-size: 16px !important; font-weight: normal !important">';

                // pokemon sorting
                if(isset($_POST['hp']) and !empty($_POST['hp_val'])) {   
                    $hp = $_POST['hp'];
                    $hp_val = $_POST['hp_val'];
                    echo '<li> with HP ' . $hp . ' than ' . $hp_val . '</li>';
                    if (strcmp($hp, "more") == 0) {
                        // looking for pokemon w/ hp greater than hp_val
                        $poke_sql .= "AND hp > ";                        
                    }
                    else {
                        // looking for pokemon w/ hp less than hp_val
                        $poke_sql .= "AND hp < ";   
                    }
                    $poke_sql .= $hp_val;
                };

                if(isset($_POST['type'])) {
                    $type = $_POST['type'];
                    echo '<li>' . $type . '-type pokemon </li>';
                    $poke_sql .= " AND type LIKE '%" . $type . "%'";
                };

                // team sorting
                if(isset($_POST['battles']) and !empty($_POST['total_battles'])) {   
                    $battles = $_POST['battles'];
                    $total_battles = $_POST['total_battles'];
                    echo '<li> with ' . $battles . ' than ' . $total_battles . ' battles </li>';
                    if (strcmp($battles, "more") == 0) {
                        // looking for pokemon w/ hp greater than hp_val
                        $team_sql .= "AND total_battles >= ";                        
                    }
                    else {
                        // looking for pokemon w/ hp less than hp_val
                        $team_sql .= "AND total_battles <= ";   
                    }
                    $team_sql .= $total_battles;
                };

                if (isset($_POST["wl"])) {
                    $wl = $_POST["wl"];
                    echo '<li> with ' . $wl . ' wins than losses </li>';
                    if (strcmp($wl, "less") == 0) {
                        $team_sql .= " AND wins < losses";       
                    }  
                    elseif (strcmp($wl, "more") == 0) {
                        $team_sql .= " AND wins > losses";      
                    }
                }
 

                $team_sql .= ";";
                $poke_sql .= ";";

                echo '</ul><hr/>';
                
                # return matching teams
                echo'<h4> By team: </h4>';
                if (!mysqli_stmt_prepare($stmt, $team_sql)) {
                    header("Location: ../search.php?query=$query&error=sqlerror");
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt, "s", $query);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    while($row = mysqli_fetch_assoc($result)) {
                        echo 
                        '<div class="card" style="margin: 1%; width: 45%; display: inline-block">
                            <div class="container" style="padding-top: 10px">
                                <h4><b>'.$row["tname"].'</b></h4>
                                <p style="line-height:1">Wins: '.$row["wins"].', Losses: '.$row["losses"].'</p>
                                <p style="line-height:1">Total Battles: '.$row["total_battles"].'</p>
                            </div>
                        </div>';
                    }
                }
                
                # return matching pokemon
                echo '<hr/>';
                echo'<h4> By pokemon: </h4>';
                if (!mysqli_stmt_prepare($stmt, $poke_sql)) {
                    header("Location: ../search.php?query=$query&error=sqlerror");
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt, "s", $query);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    while($row = mysqli_fetch_assoc($result)) {
                        echo 
                        '<div class="card" style="margin: 1%; width: 45%; display: inline-block; padding-top: 10px">
                            <img style="position: absolute; right: 10px;" src="'.$row["picURL"].'" alt="Avatar" style="width:10%">
                            <div class="container">
                                <h4><b>'.$row["pname"].'</b></h4>
                                <p style="line-height:1">Type: '.$row["type"].'</p>
                                <p style="line-height:1">HP: '.$row["hp"].'</p>
                            </div>
                        </div>';
                    }
                }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
        ?>
        </section>
      </div>
    </main>