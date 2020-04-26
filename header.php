<?php
  // First we start a session which allow for us to store information as SESSION variables.
  session_start();
  // "require" creates an error message and stops the script. "include" creates an error and continues the script.
  require "includes/dbh.inc.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="This is an example of a meta description">
        <meta name=viewport content="width=device-width, initial-scale=1">
        <title></title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        
    </head>
    <body>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <header>
            <nav class="nav-header-main">
                <a class="header-logo" href="index.php">
                    <img src="img/logo.jpg" alt="mmtuts logo" width=200% height=auto>
                </a>
                <ul>
                    <li><a href="index.php" style="padding: 5px">Home</a></li>
                    <?php
                    if (isset($_SESSION['id'])) {
                    echo '<li><a href="view.php" style="padding: 5px">View Teams</a></li>
                    <li><a href="create.php" style="padding: 5px">Create Team</a></li>
                    <li><a href="battle.php" style="padding: 5px">Battle Your Teams</a></li>
                    <li><a href="adv-search.php" style="padding: 5px">Search</a></li>
                    <li><a href="import.php" style="padding: 5px">Import Team Data</a></li>
                    <li> <form action="includes/logout.inc.php" method="post" style="position: absolute; padding: 5px; top: 5px">
                    <button class= "btn btn-primary my-2 my-sm-0" type="submit" name="login-submit">Logout</button>
                    </form> </li>
                    <li><form action="search.php" method="post" style="position: absolute; padding: 8px; top: 5px; right: 20px;" class="form-inline">
                    <input class="form-control mr-sm-2" type="search" name="search_query" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-primary my-2 my-sm-0" style="margin-right: 5px;" name="search-submit" type="submit">Search</button>
                    </form></li>';
                    }
                    else if (!isset($_SESSION['id'])){
                        echo '<li> <div class="login-container">
                            <form action="includes/login.inc.php" method="post" style="position: absolute; padding: 8px; top: 5px; right: 20px">
                            <input type="text" name="mailuid" placeholder="E-mail/Username">
                            <input type="password" name="pwd" placeholder="Password">
                            <button class="btn btn-primary my-2 my-sm-0" type="submit" name="login-submit">Login</button>
                            </form>
                        </div> </li>';
                    }
                    ?>
                </ul>


                </nav>
                
        </header>