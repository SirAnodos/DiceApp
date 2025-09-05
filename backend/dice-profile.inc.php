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
    public function __construct(string $id, string $name) {
        $this->id = $id;
        $this->name = $name;
        $this->rolls = [];
    }

    // add new roll
    public function addRoll(string $id, string $name, string $dice[]) {
        include('saved-roll.inc.php');
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