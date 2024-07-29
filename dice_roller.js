// JS for dice roller page (roller.php)

// globals
const DICEMAP = [4, 6, 8, 10, 12, 20, 100,]; //array of dice sizes
let dice = [0, 0, 0, 0, 0, 0, 0,]; // how many dice are currently being displayed
let resultsShown = false; // bool are roll results being displayed

// update dice sprites shown and array dice using dice input fields
function updateDice(sides) {
  // get selected number of dice
  let counterElmt = document.getElementById("d" + sides.toString() + "-input");
  let numDice = Number(counterElmt.value);
  // ensure that number of dice is not higher than MAXDICE
  numDice = validateSelection(counterElmt, numDice);
  // hide results if they have already been shown for this roll
  if (resultsShown) {hideResults();}
  // show or hide the correct number of dice sprites
  let dieIdx = DICEMAP.indexOf(sides);
  if (numDice > dice[dieIdx]) { // show dice
    for (let spriteIdx = dice[dieIdx]; spriteIdx < numDice; spriteIdx++) {
      let sprite = document.getElementById("die-sprite-"+ (10 * dieIdx + spriteIdx).toString());
      sprite.style.display = "inline-block";
    }
  } else if (numDice < dice[dieIdx]) { // hide dice
    for (let spriteIdx = dice[dieIdx] - 1; spriteIdx >= numDice; spriteIdx--) {
      let sprite = document.getElementById("die-sprite-"+ (10 * dieIdx + spriteIdx).toString());
      sprite.style.display = "none";
    }
  }
  dice[dieIdx] = numDice; // update record of visible sprites
}

// set every sprite's result string to "" and clear bool resultsShown
function hideResults() {
  for (let spriteIdx = 0; spriteIdx < 70; spriteIdx++) {
    let sprite = document.getElementById("die-sprite-"+ (spriteIdx).toString());
    sprite.innerHTML = "";
  }
  resultsShown = false;
}

// call updateDice for each input field. called when the page first loads
function showDiceOnLoad() {
  DICEMAP.forEach(updateDice);
  resultsShown = true;
}
