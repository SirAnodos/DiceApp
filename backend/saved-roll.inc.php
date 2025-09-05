<?php
// Class for a single saved dice roll.
// A saved roll is a combination of dice for a specific action, event, or other rule.
class SavedRoll {
    // properties
    private $id;
    private $name;
    private $d4;
    private $d6;
    private $d8;
    private $d10;
    private $d12;
    private $d20;

    // constructor
    public function __construct(string $id, string $name, string $dice[]) {
        $this->id = $id;
        $this->name = $name;
        list($this->d4, $this->d6, $this->d6, $this->d8, $this->d10,
            $this->d12, $this->d20, $this->d100) = $dice;
    }

    // return roll data
    public function getRollData() {
        return [
            "id" => $this->id
            "name" => $this->name
            "d4" => $this->d4
            "d6" => $this->d6
            "d8" => $this->d8
            "d10" => $this->d10
            "d12" => $this->d12
            "d20" => $this->d20
            "d100" => $this->d100
        ];
    }
}  