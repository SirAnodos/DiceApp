// Open and close login/account dropdown

function hideShowDropdown(button, dropdown) {
    let dropdownElmt = document.getElementById(dropdown);
    let buttonElmt = document.getElementById(button);
    if (dropdownElmt.style.display == "none" || dropdownElmt.style.display == "") {
        console.debug("show");
        dropdownElmt.style.display = "inline";
        buttonElmt.classList.add("active-page");
    } else {
        console.debug("hide");
        dropdownElmt.style.display = "none";
        buttonElmt.classList.remove("active-page");
    }
}