<?php
// Class for a single saved dice roll.
// A saved roll is a combination of dice for a specific action, event, or other rule.
class SavedRoll {
    // properties
    private $name;
    private $d4;
    private $d6;
    private $d8;
    private $d10;
    private $d12;
    private $d20;

    public function __construct(string $name, string $dice[]) {
        $this->name = $name;
        list($this->d4, $this->d6, $this->d6, $this->d8, $this->d10,
            $this->d12, $this->d20, $this->d100) = $dice;
    }
}  