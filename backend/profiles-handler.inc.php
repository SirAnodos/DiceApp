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
        $pQry = $this->connection->prepare("SELECT * FROM profiles WHERE uid = ?");
        $pQry->bind_param('s', $_SESSION['uid']);
        $pQry->execute();

        // load data for each profile (for each result row from the above query)
        while ($pRow = $pQry->fetch_row()) {
            // save new DiceProfile object
            array_push($this->profiles, new DiceProfile($pRow[0], $pRow[1]));
            // DB query: get rolls where profile == id of this profile
            $rQry = $this->connection->prepare("SELECT * FROM rolls WHERE profile_id = ?");
            $rQry->bind_param('s', $pRow[0]);
            $rQry->execute();
            // load each roll and add it to this profile (for each result row from the above query)
            while ($rRow = $rQry->fetch_row()) {
                end($this->rolls)->addRoll($rRow[0], $rRow[1], array_slice($rRow, 2, 7));
            }
        }

        // save the loaded data to $_SESSION
        $_SESSION['save-data'] = $this->json_encode();

        // return success message
        return array(200, 'Save data retrieved.');
    }

    public function addProfile($name) {
        // if name is not provided, return error message.
        if (is_null($name) || $name == '') {
            return array(422, 'Profile name required.');
        // else, create the profile
        } else {
            // create DB entry
            $qry = $this->connection->prepare(("INSERT INTO `profiles` (`id`, `profile_name`, `u_id`) VALUES (NULL, ?, ?)"))
            $qry->bind_param('ss', $name, $_SESSION['uid']);
            $qry->execute();
            // add new profile to $_SESSION
            $saveData = $_SESSION['save-data'].json_decode();
            include_once('dice-profile.php');
            $newProfile = new DiceProfile($this->connection->insert_id, $name);
            array_push($saveData, $newProfile->getProfileData());
            $_SESSION['save-data'] = $saveData->json_encode();
            // return success message
            return array(200, 'New profile created.');
        }
    }

    public function deleteProfile($id) {
        // delete profile
        $qry = $this->connection->prepare(("DELETE FROM `profiles` WHERE id = ?"))
        $qry->bind_param('s', $id);
        $qry->execute();
        // delete associated rolls
        $qry = $this->connection->prepare(("DELETE FROM `rolls` WHERE profile_id = ?"))
        $qry->bind_param('s', $id);
        $qry->execute();
        // return success message
        return array(200, 'Profile deleted.');
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