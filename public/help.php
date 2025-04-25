<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../styles/style.css">
  <meta charset="UTF-8">
  <title>DiceApp | Help</title>
</head>
<body>

<!-- include navbar, specifying the active page -->
<?php
$activePage = 'help';
include('./include/navbar.inc.php');
?>

<div class="content-wrapper"> <!-- container for main content -->
<div class="content"> <!-- visible content div -->
  <h2 class="page-title"> DiceApp Help </h2>
  <h3 class="section-title">Dice Roller:</h3>
    <p>
      Select dice (up to 10 of each) using the form on the left. Press "Roll"
      to roll the dice and view results. Press "Reset" to clear.
    </p>
  <h3 class="section-title">Dice Statistics:</h3>
    <p>
      Select dice (up to 10 of each) and minimum roll to hit using the form on
      the left. Press "Stats" to view probability distribution, expected value
      (EV), and hit chance (HC). Press "Reset" to clear.
    </p>

</div>
</div>

<!-- footer -->
<?php include("./include/footer.inc.php"); ?>

<script src="../scripts/dropdowns.js"></script>
<script src="../scripts/account.js"></script>

</body>
</html>
