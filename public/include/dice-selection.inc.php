<!-- Dice Selection Form -->

<?php
// Different elements between the roller and statistics pages.
if ($activePage=='statistics') {
  $toHitInput = "
    <span>to hit:</span>
    <input id='to-hit' type='number' name='to-hit' value='$toHit' min=0 autocomplete='off'>
    <br>";
  $submitButton = "Stats";
} else if ($activePage=='roller') {
  $toHitInput = "";
  $submitButton = "Roll";
}

echo "<form class='input-panel' method='GET' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>";
  // echo one input for each kind of die
  foreach (DICEMAP as $sides => $idx) {
    echo "<span>d" . $sides . "s:</span>";
    echo "<input id='d" . $sides . "-input' type='number' name='d$sides'
        value='$dice[$sides]' min=0 max=MAXDICE autocomplete='off' ";
        if ($activePage=='statistics') {echo "onchange='validateSelection(this, this.value)'>";}
        else if ($activePage=='roller') {echo "onchange='updateDice($sides)'>";}
    // line break after every 2 inputs
    if ($idx % 2 != 0) {
      echo "<br>";
    }
  }
  // minimum to hit
  echo $toHitInput;
  // reset or submit form
  echo "
  <button type='submit' onclick='resetForm(this.parentElement)'>Reset</button>
  <button type='submit'>".$submitButton."</button><br>
</form>";