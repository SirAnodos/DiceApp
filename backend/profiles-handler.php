<?php

Class ProfilesHandler {
    private $uid;
    private $connection;

    public function __construct(string $uid) {
        $this->uname = $uid;
        include("db-connect.php"); // we should probably do this differently.
        $this->connection = dbConnect();
    }

    public function loadProfiles() {
        //loads all profiles connected to $this->uid
        //returns JSON with all profiles and their rolls
    }

    public function saveProfile($name, $profile) {
        //accepts name of profile and JSON with profile contents
        //saves 
        //returns status message
    }

    public function deleteProfile($name) {
        //accepts name of profile
        //selects profile with given name and current uid
        //deletes profile and all associated rolls
        //returns status message
    }

    public function saveRoll($name, $roll, $profileName) {
        //accepts name of roll, JSON with roll contents, and name of profile
        //saves roll
        //returns status message
    }

    public function deleteRoll($name, $profileName) {
        //accepts name of roll and name of profile (SHOULD THIS BE ID OF PROFILE?)
        //selects profile with given names and current uid
        //deletes roll
        //returns status message
    }
}


include("dice-profile.inc.php");
include("db-connect.php");
$connection = dbConnect();

session_start();
$profiles = [];
// DB query: get profiles where uid == $_SESSION[id]
$pQry = $connection->prepare("SELECT * FROM profiles WHERE uid = ?");
$pQry->bind_param('s', $_SESSION['uname']);
$pQry->execute();

// load roll data and create DiceProfile objects
// for each result row (each profile)
while ($pRow = $pQry->fetch_row()) {
    // DB query: get rolls where profile == id of this profile
    $rQry = $connection->prepare("SELECT * FROM rolls WHERE profile_id = ?");
    $rQry->bind_param('s', $pRow[0]);
    $rQry->execute();
    // save each result row (each saved roll)
    $rolls = [];
    while ($rRow = $rQry->fetch_row()) {
        array_push($rolls, new SavedRoll($rRow[1], array_slice($rRow, 2, 7)))
    }
    // add to $profiles new profile object, including the loaded rolls
    array_push($profiles, new DiceProfile($pRow[0], $pRow[1], ...$rolls))
}
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