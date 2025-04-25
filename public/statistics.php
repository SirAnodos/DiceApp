<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../styles/style.css">
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

// get values from form GET and validate
if (sizeof($_GET) > 0) {
  foreach ($dice as $sides => $count) {
    $dice[$sides] = max(min($_GET["d" . $sides], MAXDICE), 0);
  }
  $toHit = max($_GET["to-hit"], 0);
}

// calculate cardinality of each event  (O(n) time)
$events = [0 => 1]; // iteration 0
foreach ($dice as $sides => $count) { // for each kind of die:
  for ($die = 0; $die < $count; $die++) { // for each die of this kind:
    $newEvents = [];
    // smallest and largest possible events before rolling this die
    $minEvent = min(array_keys($events));
    $maxEvent = max(array_keys($events));
    // for each event which is possible after rolling this die:
    for ($event = $minEvent + 1; $event <= $maxEvent + $sides; $event++) {
      // smallest and largest preceding events which can lead to this event
      $minPrec = max($event - $sides, $minEvent) - $minEvent;
      $maxPrec = min($event - 1, $maxEvent) - $minEvent;
      // all preceding events which can lead to this roll
      $precs = array_slice($events, $minPrec, $maxPrec - $minPrec + 1);
      // record this event and its cardinality (sum of all precedents)
      $newEvents[$event] = array_sum($precs);
    }
    $events = $newEvents;
  }
}

// convert cardinalities into a probability distribution
$distribution = [];
$cardS = array_sum($events);
foreach ($events as $event => $cardE) {
  $distribution[$event] = $cardE / $cardS;
}
?>

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
  // find hit chance
  if (array_key_exists($toHit, $distribution)) {
    $idx = array_search($toHit, array_keys($distribution));
    $hitChance = array_sum(array_slice($distribution, $idx));
  } else {
    $hitChance = 0;
  }
  // find expected value
  $EV = 0;
  foreach ($distribution as $event => $probability) {
    $EV += ($event * $probability);
  }
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
