<?php
  require "header.php";
?>

    <main>
      <div class="wrapper-main">
        <section class="section-default">
          <h1>Create Team</h1>
          <form class="form-signup" action="includes/create.inc.php" method="post">
            <input type="text" name="team" placeholder="Team Name">
            <button type="submit" name="create-submit">Submit</button>
          </form>
        </section>
      </div>
    </main>


