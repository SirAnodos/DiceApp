<!-- Dice Selection Form -->

<?php
echo "<form class='input-panel' method='GET' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>";
  // echo one input for each kind of die
  foreach (DICEMAP as $sides => $idx) {
    echo "<span>d" . $sides . "s:</span>";
    echo "<input id='d" . $sides . "-input' type='number' name='d$sides'
        value='$dice[$sides]' min=0 max=MAXDICE autocomplete='off'";
    if ($activePage == 'statistics') {
        echo "onchange='validateSelection(this, this.value)'>";
    } else if ($activePage == 'roller') {
        echo "onchange='updateDice($sides)' autocomplete='off'>";
    }
    // line break after every 2 inputs
    if ($idx % 2 != 0) {
      echo "<br>";
    }
  }
  if ($activePage=="statistics") {
    echo "
    <span>to hit:</span>
    <input id='to-hit' type='number' name='to-hit' value='$toHit' min=0 autocomplete='off'>
    <br>";
  }
  echo "
  <button type='submit' onclick='resetForm(this.parentElement)'>Reset</button>
  <button type='submit'>";
  if ($activePage == 'statistics') { echo "Stats";}
  else if ($activePage=='roller') {echo "Roll";}
  echo "</button><br>
</form>";