<?php
session_start();
include "../controllers/controller_session.php";
checkSessionAndRedirect($requiredRole = "Admin");
if (empty($_SESSION["id"])) {
}
?>
<html lang="en">
<head>
  <?php include "../controllers/controller_html.php";
  head("Home"); ?>
</head>
<body>
  <div id="blur">
    <header>
      <?php nav(); ?>
    </header>
    <form method="POST" action="" >
        <button name="create_backup" class="backup" value="ok" type="submit">CreateBackup</button>
    </form>
      <?php
      include "../models/connection.php";
      include "../models/backup.php";
      ?>
      
      <?php
      
      ?>
    </div>
    <footer>
      <p>Derechos Reservados &copy; DigitCol</p>
    </footer>
  </div>
  <script src="script.js"></script>
</body>
</html>