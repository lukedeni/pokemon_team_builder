<?php
  // To make sure we don't need to create the header section of the website on multiple pages, we instead create the header HTML markup in a separate file which we then attach to the top of every HTML page on our website. In this way if we need to make a small change to our header we just need to do it in one place. This is a VERY cool feature in PHP!
  require "header.php";
?>

    <main>
      <div class="wrapper-main">
        <section class="section-default" style="background-color: white;">
          <!--
          We can choose whether or not to show ANY content on our pages depending on if we are logged in or not. I talk more about SESSION variables in the login.inc.php file!
          -->
          <?php
          if (!isset($_SESSION['id'])) {
            echo '<p class="login-status">Login or Signup to Make a Team!</p>';
          }
          else if (isset($_SESSION['id'])) {
            echo '<p class="login-status">Welcome Back '.$_SESSION['uid'].'!</p>';
          }
          ?>
           <style>
            body {
            background-image: url('img/pokemon_friends.png');
            background-repeat: no-repeat;
            background-size: cover;
           
            }
          </style>
        </section>
      </div>
    </main>
