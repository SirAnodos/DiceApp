<?php
// Class for saved dice profile.
// A profile contains rolls a player needs for a specific game or character.
class DiceProfile {
    // properties
    private $id;
    private $name;
    private $rolls[];.

    //constructor
    function __construct($id, $name, ...$rolls = []) {
        $this->name = $id;
        $this->name = $name;
        $this->rolls = $rolls;
    }

    // getter and setter methods
    function id() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function name() {
        return $this->name;
    }

    function setName($name) {
        $this->name = $name;
    }

    function rolls() {
        return $this->rolls;
    }

    function lastRoll() {
        return end($this->rolls);
    }

    function setRolls($rolls) {
        $this->rolls = $rolls;
    }

    function addRoll($roll) {
        array_push($this->rolls, $roll);
    }

    function removeRoll($name) {
        foreach ($this->rolls as $i=>$roll) {
            if ($roll.name() == $name) {
                array_splice($this->rolls, $i, 1);
                break;
            }
        }
    }
}

?>