<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../styles/style.css">
  <meta charset="UTF-8">
  <title>DiceApp | Statistics</title>
</head>
<body>

<!-- calculate statistics -->
 <?php include("./include/statistics.inc.php"); ?>

<!-- include navbar, specifying the active page -->
<?php
$activePage = 'statistics';
include('./include/navbar.inc.php');
?>

<div class="content-wrapper"> <!-- container for main content -->
<div class="content"> <!-- visible content div -->

<h2 class="page-title"> Dice Statistics </h2> <!-- page title -->

<!-- Left Column -->
<div class="left-column">

<!-- Dice Selection Form -->
<form class="input-panel" method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <?php
  // echo one input for each kind of die
  foreach (DICEMAP as $sides => $idx) {
    echo "<span>d" . $sides . "s:</span>";
    echo "<input id='d" . $sides . "-input' type='number' name='d$sides'
          value='$dice[$sides]' min=0 max=MAXDICE autocomplete='off' 
          onchange='validateSelection(this, this.value)'>";
    // line break after every 2 inputs
    if ($idx % 2 != 0) {
      echo "<br>";
    }
  }

  ?>
  <span>to hit:</span><input id="to-hit" type="number" name="to-hit"
  value="<?php echo "$toHit";?>" min=0 autocomplete="off">
  <br>
  <button type="submit" onclick="resetForm(this.parentElement)">Reset</button>
  <button type="submit">Stats</button><br>
</form>

<!-- Results Panel -->
<div class="results-panel">
  <?php // find hit chance and expected value
  ?>
  <span>EV: <?php echo round($EV, 2)?></span> <br>
  <span>HC: <?php echoPercent($hitChance);?></span>
</div>
</div> <!-- end left column -->

<!-- Distribution Histogram -->
<div class="display-panel">
  <p>
    This panel will contain a histogram showing the probability distribution
    of the selected dice configuration:
  </p>
  <?php // in lieu of a histogram, just print every probability, I guess
  foreach ($distribution as $event => $probability) {
    echo "$event  =>  $probability<br>";
  }
  ?>
</div>

</div> <!-- end visible content div -->
</div> <!-- end content wrapper -->

<!-- footer -->
<?php include("./include/footer.inc.php"); ?>

<!-- functions and scripts -->
<?php // accept float value and echo a percent rounded to two decimal places
function echoPercent($percent) {
  echo round($percent * 100, 2) . "%";
}
?>

<script src="../scripts/inputs.js"></script> <!-- include input processing functions -->
<script src="../scripts/dropdowns.js"></script>
<script src="../scripts/account.js"></script>

</body>
</html>
