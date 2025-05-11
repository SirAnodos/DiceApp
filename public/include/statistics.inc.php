<!-- dice statistics functionality -->

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