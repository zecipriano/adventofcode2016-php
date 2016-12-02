<?php

namespace AdventOfCode2016\Day02;

class AlternativeKeypad
{
    protected $keypad;
    protected $currentButton;

    public function __construct()
    {
        $this->keypad = [
            [null, null, "1", null, null],
            [null, "2",  "3", "4",  null],
            ["5",  "6",  "7", "8",  "9"],
            [null, "A",  "B", "C",  null],
            [null, null, "D", null, null]
        ];
        $this->currentButton = [2, 0];
    }

    /**
     * Move to the button in the given direction. Ignores the move if already at
     * the edge or is a null position.
     *
     * @param string $direction The direction to move.
     *
     * @return void
     */
    public function move(string $direction) : void
    {
        if (!in_array($direction, ['U', 'D', 'L', 'R'])) {
            throw new InvalidArgumentException("Invalid direction.");
        }

        switch ($direction) {
            case 'U':
                if (isset($this->keypad[$this->currentButton[0] - 1][$this->currentButton[1]])) {
                    $this->currentButton[0]--;
                }
                break;
            case 'D':
                if (isset($this->keypad[$this->currentButton[0] + 1][$this->currentButton[1]])) {
                    $this->currentButton[0]++;
                }
                break;
            case 'L':
                if (isset($this->keypad[$this->currentButton[0]][$this->currentButton[1] - 1])) {
                    $this->currentButton[1]--;
                }
                break;
            case 'R':
                if (isset($this->keypad[$this->currentButton[0]][$this->currentButton[1] + 1])) {
                    $this->currentButton[1]++;
                }
                break;
        }
    }

    /**
     * Returns the currrent button.
     *
     * @return string The current button.
     */
    public function getCurrentButton() : string
    {
        return $this->keypad[$this->currentButton[0]][$this->currentButton[1]];
    }
}
