<?php
// Class for saved dice profile.
// A profile contains rolls a player needs for a specific game or character.
class DiceProfile {
    // properties
    private $id;
    private $name;
    private $rolls[];.

    // constructor
    // as it is used, this class is constructed empty, and then filled as rolls are loaded from the DB.
    public function __construct(string $id, string $name, object $connection, string $load = 'array', array $data = []) {
        $this->connection = $connection;
        $this->id = $id;
        $this->name = $name;
        if ($load == 'array') {
            $this->loadFromArray($data);
        } else if ($load == 'database') {
            $this->loadFromDatabase();
        }
    }

    // load user data from DB
    public function loadFromDatabase() {
        // DB query: get rolls where profile == id of this profile
        $qry = $this->connection->prepare("SELECT * FROM rolls WHERE profile_id = ?");
        $qry->bind_param('s', $this->id);
        $qry->execute();
        // load each roll and add it to this profile (for each result row from the above query)
        include_once('saved-roll.inc.php');
        while ($row = $qry->fetch_row()) {
            array_push($this->rolls, new SavedRoll(
                $row[0], $row[1], array_slice($row, 2, 7)
            ));
        }
    }

    // load user data from array of rolls (passed by ProfilesHander->loadFromSession())
    public function loadFromArray($data) {
        foreach ($data as $roll) {
            array_push($this->rolls, new SavedRoll(
                $roll['id'], $roll['name'], array_values())
            )
        }
    }

    // add new roll
    public function addRoll(string $id, string $name, string $dice[]) {
        include_once('saved-roll.inc.php');
        array_push($this->rolls, new SavedRoll($id, $name, $dice));
    }

    // return profile data
    public function getProfileData() {
        $data = [
            "id" => $this->id,
            "name" => $this->name,
            "rolls" => []
        ];
        foreach ($this->rolls as $roll) {
            array_push($data["rolls"], $roll->getRollData());
        }
        return $data;
    }

    // getter and setter methods. probably no need for most of these. got a little carried away.
    // function id() {
    //     return $this->id;
    // }

    // function setId($id) {
    //     $this->id = $id;
    // }

    // function name() {
    //     return $this->name;
    // }

    // function setName($name) {
    //     $this->name = $name;
    // }

    // function rolls() {
    //     return $this->rolls;
    // }

    // function lastRoll() {
    //     return end($this->rolls);
    // }

    // function setRolls($rolls) {
    //     $this->rolls = $rolls;
    // }

    // function removeRoll($name) {
    //     foreach ($this->rolls as $i=>$roll) {
    //         if ($roll.name() == $name) {
    //             array_splice($this->rolls, $i, 1);
    //             break;
    //         }
    //     }
    // }
}

?>