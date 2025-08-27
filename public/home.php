<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../styles/style.css">
  <meta charset="UTF-8">
  <title>DiceApp | Home</title>
</head>
<body>

<!-- include navbar, specifying the active page -->
<?php
$activePage = 'home';
include('./include/navbar.inc.php');
?>

<div class="content-wrapper"> <!-- container for main content -->
<div class="content"> <!-- visible content div -->

  <h2 class="page-title"> DiceApp Home </h2>
  <p>
    DiceApp is a free web-based dice roller for tabletop games. It also contains
    functionality for viewing statistics of dice configurations.
  </p>
  <p>
    DiceApp was created as a personal project by Gabriel Walker while learning
    the basics of web development. It is written from scratch in HTML/CSS,
    JavaScript, PHP, and MySQL, without the use of external libraries.
  </p>

</div>
</div>

<!-- footer -->
<?php include("./include/footer.inc.php"); ?>

<script src="../scripts/dropdowns.js"></script>
<script src="../scripts/account.js"></script>

</body>
</html>
