<?php

// object which performs functions on saved dice profiles
Class ProfilesHandler implements JsonSerializable {
    private $uid;
    private $connection;
    private $profiles[];

    public function __construct() {
        include("db-connect.php");
        $this->connection = dbConnect();
        $this->profiles = [];
    }

    // save this user's dice profiles in JSON format as a  $_SESSION variable
    public function loadProfiles() {
        // DB query: get profiles where uid == $_SESSION[id]
        $pQry = $connection->prepare("SELECT * FROM profiles WHERE uid = ?");
        $pQry->bind_param('s', $_SESSION['uid']);
        $pQry->execute();

        // load data for each profile (for each result row from the above query)
        while ($pRow = $pQry->fetch_row()) {
            // save new DiceProfile object
            array_push($this->profiles, new DiceProfile($pRow[0], $pRow[1]));
            // DB query: get rolls where profile == id of this profile
            $rQry = $connection->prepare("SELECT * FROM rolls WHERE profile_id = ?");
            $rQry->bind_param('s', $pRow[0]);
            $rQry->execute();
            // load each roll and add it to this profile (for each result row from the above query)
            while ($rRow = $rQry->fetch_row()) {
                end($this->rolls)->addRoll($rRow[0], $rRow[1], array_slice($rRow, 2, 7));
            }
        }

        $_SESSION['save-data'] = $this->json_encode();

        http_response_code(200);
        echo "Saved data retrieved.";
    }

    public function addProfile($name) {
        //accepts name of profile
        //saves (uses $_SESSION['uid'])
        //returns status message
    }

    public function deleteProfile($id) {
        //accepts name of profile
        //selects profile with given name and current uid
        //deletes profile and all associated rolls
        //returns status message
    }

    public function addRoll($name, $profileId, $roll) {
        //accepts name of roll, JSON with roll contents, and name of profile
        //saves roll
        //returns status message
    }

    public function deleteRoll($id) {
        //accepts name of roll and name of profile (SHOULD THIS BE ID OF PROFILE?)
        //selects profile with given names and current uid
        //deletes roll
        //returns status message
    }

    public function overwriteRoll($id) {

    }

    // serialize the data of each profile in an array
    public function jsonSerialize() {
        $data = [];
        foreach ($this->profiles as $profile) {
            array_push($data, $profile->getProfileData());
        }
        return $data;
    }
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
// at some point in this file, save rolls to a cookie. //
?>