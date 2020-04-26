<?php
  require "header.php";
?>

<style>
body {
      background-image: url('img/pokemon_background2.jpg');
      height: 100%;
      background-position: center;
      background-size: cover;
      }
    </style>

    <main>
      <div class="wrapper-main">
        <section class="section-default">
          <h1 style="padding-top:50px;">Create Team</h1>
          <form class="form-signup" action="includes/create.inc.php" method="post">
            <input type="text" name="team" placeholder="Team Name">
            <button type="submit" name="create-submit">Submit</button>
          </form>
        </section>
      </div>
    </main>



