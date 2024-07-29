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


if (sizeof($_GET) > 0) {
  foreach ($dice as $sides => $count) {
    $dice[$sides] = max(min($_GET["d" . $sides], MAXDICE), 0);
  }
}

$totalRoll = 0;
$rolls = array_map(function() {return "";}, range(0, TOTALDICE - 1));
if (array_sum($dice) > 0) {
  foreach ($dice as $sides => $count) {
    for ($roll = 0; $roll < $count; $roll++) {
      $result = rand(1, $sides);
      $totalRoll += $result;
      $rolls[MAXDICE * DICEMAP[$sides] + $roll] = $result;
    }
  }
  unset($result);
}
?>

<ul class="nav-bar">
  <li> <a href="home.html">HOME</a> </li>
  <li class="active-page"> <a href="roller.php">ROLLER</a> </li>
  <li> <a href="statistics.php">STATISTICS</a> </li>
  <li> <a href="help.html">HELP</a> </li>
</ul>

<div class="content-wrapper">
<div class="content">

<h2 class="page-title"> Dice Roller </h2>

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
<ul class="dice-sprites">
<?php
for ($sprite = 0; $sprite < TOTALDICE; $sprite++) {
  $img = 50 * intdiv($sprite, 10);
  echo "<li id='die-sprite-$sprite' style='background: url(dice-sprites.gif) 0 -" . $img . "px'>$rolls[$sprite]</li>";
}
?>
</ul>
</div>

</div>
</div>

<script src="inputs.js"></script>
<script src="dice_roller.js"></script>
<script> showDiceOnLoad(); </script>

</body>
</html>