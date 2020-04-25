<?php
require "header.php";
?>


<main>
    <div class="wrapper-main">
    <section class="section-default">
        <?php
        if (isset($_POST['search-submit'])) {
            $query = $_POST['search_query'];
        
            // if (empty($query)) {
            //     header("Location: ../search.php?query=$query&error=emptysearchquery");
            //     exit();
            // }

            // else {

                $team_sql = "SELECT * FROM team WHERE tname LIKE CONCAT('%', ?, '%');";
                $poke_sql = "SELECT * FROM pokemon2 WHERE pname LIKE CONCAT('%', ?, '%');";

                $stmt = mysqli_stmt_init($conn);

                echo '<h2> Search results for '; echo $query;
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
                        '<div class="card">
                            <div class="container">
                                <h4><b>'.$row["tname"].'</b></h4>
                                <p>Wins: '.$row["wins"].', Losses: '.$row["losses"].'</p>
                                <p>Total Battles: '.$row["total_battles"].'</p>
                            </div>
                        </div>';
                    }
                }
                
                # return matching pokemon
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
                mysqli_stmt_close($stmt);
            
            // }
            mysqli_close($conn);
        }
        ?>
        </section>
      </div>
    </main>