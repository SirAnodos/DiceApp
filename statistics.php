<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css">
  <meta charset="UTF-8">
  <title>DiceApp | Statistics</title>
</head>

<body>

<?php
// define variables
const DICEMAP = [4 => 0, 6 => 1, 8 => 2, 10 => 3, 12 => 4, 20 => 5, 100 => 6,];
const MAXDICE = 10;
const TOTALDICE = 7 * MAXDICE;
$dice = [4 => 0, 6 => 0, 8 => 0, 10 => 0, 12 => 0, 20 => 0, 100 => 0,];
$toHit = 0;

if (sizeof($_GET) > 0) {
  foreach ($dice as $sides => $count) {
    $dice[$sides] = max(min($_GET["d" . $sides], MAXDICE), 0);
  }
  $toHit = max($_GET["to-hit"], 0);
}

/* calculate cardinality of each event  (O(n) time) */
$events = [0 => 1];
foreach ($dice as $sides => $count) {
  for ($die = 0; $die < $count; $die++) {
    $newEvents = [];
    $minEvent = min(array_keys($events));
    $maxEvent = max(array_keys($events));
    for ($event = $minEvent + 1; $event <= $maxEvent + $sides; $event++) {
      $minPrec = max($event - $sides, $minEvent) - $minEvent;
      $maxPrec = min($event - 1, $maxEvent) - $minEvent;
      $newEvents[$event] = array_sum(array_slice($events, $minPrec, $maxPrec - $minPrec + 1));
    }
    $events = $newEvents;
  }
}

/* convert cardinalities into a probability distribution */
$distribution = [];
$cardS = array_sum($events);
foreach ($events as $event => $cardE) {
  $distribution[$event] = $cardE / $cardS;
}
?>

<ul class="nav-bar">
  <li> <a href="home.html">HOME</a> </li>
  <li> <a href="roller.php">ROLLER</a> </li>
  <li class="active-page"> <a href="statistics.php">STATISTICS</a> </li>
  <li> <a href="help.html">HELP</a> </li>
</ul>

<div class="content-wrapper">
<div class="content">

<h2 class="page-title"> Dice Statistics </h2>

<!-- Left Column -->
<div class="left-column">

<!-- Dice Selection Form -->
<form class="input-panel" method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<?php
foreach (DICEMAP as $sides => $idx) {
  echo "<span>d" . $sides . "s:</span>";
  echo "<input id='d" . $sides . "-input' type='number' name='d$sides'
        value='$dice[$sides]' min=0 max=MAXDICE autocomplete='off'>";
  if ($idx % 2 != 0) {
    echo "<br>";
  }
}
?>
<span>to hit:</span><input id="to-hit" type="number" name="to-hit" value="<?php echo "$toHit";?>" min=0 autocomplete="off">
<br>
<button type="submit" onclick="resetForm(this.parentElement)">Reset</button>
<button type="submit">Stats</button><br>
</form>

<!-- Results Panel -->
<div class="results-panel">
<?php
/* find to hit probability */
if (array_key_exists($toHit, $distribution)) {
  $idx = array_search($toHit, array_keys($distribution));
  $hitChance = array_sum(array_slice($distribution, $idx));
} else {
  $hitChance = 0;
}
/* find expected value */
$EV = 0;
foreach ($distribution as $event => $probability) {
  $EV += ($event * $probability);
}
?>
<span>EV: <?php echo round($EV, 2)?></span> <br>
<span>HC: <?php echoPercent($hitChance);?></span>
</div>
</div>

<!-- Distribution Graph -->
<div class="display-panel">
<p>This panel will contain a histogram showing the probability distribution of the selected dice configuration:</p>
<?php
foreach ($distribution as $event => $probability) {
  echo "$event  =>  $probability<br>";
}
?>
</div>

</div>
</div>

<!--
<ul class="footer">
  <li> Gabriel Walker </li>
  <li> 2024 </li>
</ul>
-->

<?php
function echoPercent($percent) {
  echo round($percent * 100, 2) . "%";
}
?>
<script src="inputs.js"></script>

</body>
</html>