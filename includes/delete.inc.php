<?php

if (isset($_POST['delete'])) {

    require 'dbh.inc.php';
    $poke =$_POST['poke_id'];
    $team_id = $_POST['team_id'];

    $sql = "DELETE FROM contains WHERE poke_id=$poke";

    header("Location: ../viewteam.php?team_id=".$team_id."");
    exit();

    
}
else {
    header("Location: ../viewteam.php?team_id=".$team_id."");
    exit();
}

?>



