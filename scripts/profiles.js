// When the user selects a different dice profile, update the saved roll options.
function changeProfile(selector, profileName) {
    // loop through children of the selector element
    let rollOptions = selector.children;
    for (let i=0; i<rollOptions.length; i++) {
        let rollOption = rollOptions[i];
        // if this option belongs to the selected profile, set it visible. else, hidden.
        if (rollOption.getAttribute("name") == profileName) {
            rollOption.hidden = false;
        } else {
            rollOption.hidden = true;
        }
    }
}