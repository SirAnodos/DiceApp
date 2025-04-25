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