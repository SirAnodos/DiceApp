<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css">
  <meta charset="UTF-8">
  <title>DiceApp | Roller</title>
</head>
<body>

<?php
// define variables
const DICEMAP = [4 => 0, 6 => 1, 8 => 2, 10 => 3, 12 => 4, 20 => 5, 100 => 6,];
const MAXDICE = 10;
const TOTALDICE = 7 * MAXDICE;
$dice = [4 => 0, 6 => 0, 8 => 0, 10 => 0, 12 => 0, 20 => 0, 100 => 0,];

// get values from form GET and validate
if (sizeof($_GET) > 0) {
  foreach ($dice as $sides => $count) {
    $dice[$sides] = max(min($_GET["d" . $sides], MAXDICE), 0);
  }
}

// roll dice and track total
$totalRoll = 0;
// empty array of rolls
$rolls = array_map(function() {return "";}, range(0, TOTALDICE - 1));
if (array_sum($dice) > 0) {
  foreach ($dice as $sides => $count) { // for each kind of die
    for ($roll = 0; $roll < $count; $roll++) { // for each die of this kind
      // roll the die, add to total roll, and save in the array
      $result = rand(1, $sides);
      $totalRoll += $result;
      $rolls[MAXDICE * DICEMAP[$sides] + $roll] = $result;
    }
  }
}
?>

<!-- Navigation Bar -->
<ul class="nav-bar">
  <li> <a href="home.php">HOME</a> </li>
  <li class="active-page"> <a href="roller.php">ROLLER</a> </li>
  <li> <a href="statistics.php">STATISTICS</a> </li>
  <li> <a href="help.php">HELP</a> </li>
</ul>

<div class="content-wrapper"> <!-- container for main content -->
<div class="content"> <!-- visible content div -->

<h2 class="page-title"> Dice Roller </h2> <!-- page title -->

<!-- Left Column -->
<div class="left-column">

<!-- Dice Selection Form -->
<form class="input-panel" method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <?php
  foreach (DICEMAP as $sides => $idx) {
    echo "<span>d" . $sides . "s:</span>";
    echo "<input id='d" . $sides . "-input' type='number' name='d$sides'
          value='$dice[$sides]' min=0 max=MAXDICE
          onchange='updateDice($sides)' autocomplete='off'>";
    if ($idx % 2 != 0) {
      echo "<br>";
    }
  }
  ?>
  <br>
  <button type="submit" onclick="resetForm(this.parentElement)">Reset</button>
  <button type="submit">Roll</button><br>
</form>

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
      echo "<li id='die-sprite-$sprite' style='background: url(dice-sprites.gif)
            0-" . $img . "px'>$rolls[$sprite]</li>";
    }
    ?>
  </ul>
</div>

</div> <!-- end visible content div -->
</div> <!-- end content wrapper -->

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

<!-- functions and scripts -->
<script src="inputs.js"></script> <!-- include input processing functions -->
<script src="dice_roller.js"></script> <!-- include graphics box functions -->
<script> showDiceOnLoad(); </script> <!-- on load, show the selected dice -->

</body>
</html>
