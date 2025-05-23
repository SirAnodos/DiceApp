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
  <ul>
    <li style="list-style-type:none">development notes:</li>
    <li>Make distribution histogram for statistics page.</li>
    <li>Make the whole site less fugly.</li>
    <li>Should have been using CSS flexbox this whole time. Read up on that.</li>
    <li>Scalable dice graphics. But that might increase load times.</li>
    <li>Save/import dice configurations and roll history?</li>
  </ul>

</div>
</div>

<!-- footer -->
<?php include("./include/footer.inc.php"); ?>

<script src="../scripts/dropdowns.js"></script>
<script src="../scripts/account.js"></script>

</body>
</html>
