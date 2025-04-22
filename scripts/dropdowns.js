// Open and close login/account dropdown

function hideShowDropdown(button, dropdown) {
    let dropdownElmt = document.getElementById(dropdown);
    let buttonElmt = document.getElementById(button);
    if (dropdownElmt.style.display == "none" || dropdownElmt.style.display == "") {
        dropdownElmt.style.display = "inline";
        buttonElmt.classList.add("active-page");
    } else {
        dropdownElmt.style.display = "none";
        buttonElmt.classList.remove("active-page");
        document.getElementById("status-msg").innerHTML = "";
    }
}