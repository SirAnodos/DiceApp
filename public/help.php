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
<ul class="footer">
  <li>
    Gabriel Walker
    <?php echo " " . date("Y"); ?>
  </li>
  <li>Background Image by
    <a href="https://unsplash.com/@dan_horgan?utm_content=creditCopyText&
    utm_medium=referral&utm_source=unsplash">Dan Horgan</a> on
    <a href="https://unsplash.com/photos/background-pattern-gMU6nVaU8Tk?utm_
    content=creditCopyText&utm_medium=referral&utm_source=unsplash">Unsplash</a>
  </li>
</ul>

<script src="../scripts/dropdowns.js"></script>
<script src="../scripts/account.js"></script>

</body>
</html>
