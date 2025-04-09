// JS for validating and clearing input fields

const MAXDICE = 10; // do not allow the user to select more than this number of dice

// ensure that number of dice is not higher than MAXDICE
function validateSelection(counterElmt, numDice) {
  if (numDice > MAXDICE) {
    counterElmt.value = MAXDICE;
    return MAXDICE;
  }
  return numDice;
}

// clear all input fields. called when reset button is pressed
function resetForm(form) {
  let formElmts = form.children;
  for (let elmtIdx = 0; elmtIdx < formElmts.length; elmtIdx++) {
    if (formElmts[elmtIdx].type == "number") {formElmts[elmtIdx].value = 0;}
  }
}
