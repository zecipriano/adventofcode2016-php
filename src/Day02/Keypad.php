<?php

namespace AdventOfCode2016\Day02;

class Keypad
{
    protected $keypad;
    protected $currentButton;

    public function __construct()
    {
        $this->keypad = [[1, 2, 3], [4, 5, 6], [7, 8, 9]];
        $this->currentButton = [1, 1];
    }

    /**
     * Move to the button in the given direction. Ignores the move if already at
     * the edge.
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
                $this->currentButton[0] = max(0, $this->currentButton[0] - 1);
                break;
            case 'D':
                $this->currentButton[0] = min(2, $this->currentButton[0] + 1);
                break;
            case 'L':
                $this->currentButton[1] = max(0, $this->currentButton[1] - 1);
                break;
            case 'R':
                $this->currentButton[1] = min(2, $this->currentButton[1] + 1);
                break;
        }
    }

    /**
     * Returns the currrent button.
     *
     * @return int The current button.
     */
    public function getCurrentButton() : int
    {
        return $this->keypad[$this->currentButton[0]][$this->currentButton[1]];
    }
}
