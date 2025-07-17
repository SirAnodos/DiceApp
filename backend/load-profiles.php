<?php
include("db-connect.php");
include("dice-profile.inc.php");

session_start();
$profiles = [];
// DB query: get profiles where uid == $_SESSION[id]
$qry = $connection->prepare("SELECT * FROM profiles WHERE uid = ?");
$qry->bind_param('s', $_SESSION['uname']);
$qry->execute();

// for each result row (each profile)
while ($pRow = $qry->fetch_row()) {
    // add to $profiles new profile object
    array_push($profiles, new DiceProfile($pRow[0], $pRow[1]))
    // DB query: get rolls where profile == id of this profile
    $qry = $connection->prepare("SELECT * FROM profiles WHERE uid = ?");
    $qry->bind_param('s', $_SESSION['uname']);
    $qry->execute();
    // for each result row (each saved roll)
    while ($rRow = $qry->fetch_row()) {
        
    }
}
//   for each result row (each saved roll)
//     profile->addRoll(this roll)
// 
// echo saved dice form:
// <div>
//   <select> profile selector, onChange reference change-profile.js
//     <option> None </option>
//     for $profile in $profiles, echo <option> element
//   </select>
//   <select> roll selector
//     <option> None </option>
//     for $profile in $profiles,
//       for $roll in $profile->getRolls(), echo <option> element with hidden attribute
//         <option> should have name="$profile->getName()"
//   </select>
// 
// figure out inputs for saving. Need:
// new profile - dropdown appears with name and save button
// delete profile - dropdown appears with confirm and cancel
// new roll - dropdown appears with name and save button
// overwrite roll - dropdown appears with confirm and cancel
// delete roll - dropdown appears with confirm and cancel
// 
// at some point in this file, save rolls to a cookie.
?>