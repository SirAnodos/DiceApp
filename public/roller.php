<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../styles/style.css">
  <meta charset="UTF-8">
  <title>DiceApp | Roller</title>
</head>
<body>

<!-- roll dice -->
<?php include("./include/roller.inc.php"); ?>

<!-- include navbar, specifying the active page -->
<?php
$activePage = 'roller';
include('./include/navbar.inc.php');
?>

<div class="content-wrapper"> <!-- container for main content -->
<div class="content"> <!-- visible content div -->

<h2 class="page-title"> Dice Roller </h2> <!-- page title -->

<!-- Left Column -->
<div class="left-column">

<!-- Dice Selection Form -->
<?php include("./include/dice-selection.inc.php");?>

<!-- Results Panel -->
<div class="results-panel">
  <span>Total: <?php echo "$totalRoll";?></span>
</div>
</div>

<!-- Graphical Dice Box -->
<div class="display-panel">
  <ul class="dice-sprites"> <!-- ul of 70 dice sprites, initially invisible -->
    <?php // echo 70 li into the ul
    for ($sprite = 0; $sprite < TOTALDICE; $sprite++) {
      $img = 50 * intdiv($sprite, 10);
      echo "<li id='die-sprite-$sprite' style='background: url(../media/dice-sprites.gif)
            0-" . $img . "px'>$rolls[$sprite]</li>";
    }
    ?>
  </ul>
</div>

</div> <!-- end visible content div -->
</div> <!-- end content wrapper -->

<!-- footer -->
<?php include("./include/footer.inc.php"); ?>

<!-- functions and scripts -->
<script src="../scripts/inputs.js"></script> <!-- include input processing functions -->
<script src="../scripts/dice_roller.js"></script> <!-- include graphics box functions -->
<script> showDiceOnLoad(); </script> <!-- on load, show the selected dice -->
<script src="../scripts/dropdowns.js"></script>
<script src="../scripts/account.js"></script>

</body>
</html>
