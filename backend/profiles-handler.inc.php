<?php

// object which performs functions on saved dice profiles
// implements CRUD in an object-oriented manner
Class ProfilesHandler {
    private $connection;
    private $profiles[];

    public function __construct($load = 'session') {
        include_once("db-connect.php");
        $this->connection = dbConnect();
        // load data either already in $_SESSION or fresh from DB
        if ($load == 'session') {
            $this->loadFromSession();
        } else if ($load == 'database') {
            $this->loadFromDatabase();
            $_SESSION['save-data'] = $this->saveToJson(); // save the loaded data to $_SESSION
        }
    }

    // load user data from database
    public function loadFromDatabase() {
        // DB query: get profiles where uid == $_SESSION[id]
        $qry = $this->connection->prepare("SELECT * FROM profiles WHERE uid = ?");
        $qry->bind_param('s', $_SESSION['uid']);
        $qry->execute();

        // load data for each profile (for each result row from the above query)
        include_once('dice-profile.php');
        while ($row = $qry->fetch_row()) {
            // save new DiceProfile object
            array_push($this->profiles, new DiceProfile(
                $row[0], $row[1], $connection, load: 'database'
            ));
        }
    }

    // load user data from $_SESSION
    public function loadFromSession() {
        $data = $_SESSION['save-data'];
        foreach ($data as $profile) {
            array_push($this->profiles, new DiceProfile(
                $profile['id'], $profile['name'], $connection, data: $profile['rolls']
            ));
        }
    }

    public function addProfile($name) {
        // if name is not provided, return error message.
        if (is_null($name) || $name == '') {
            return array(422, 'Profile name required.');
        // else, create the profile
        } else {
            // create profile object

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
    public function saveToJson() {
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