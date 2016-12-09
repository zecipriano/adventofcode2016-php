<?php

namespace AdventOfCode2016\Day02;

abstract class Keypad
{
    protected $keypad;
    protected $currentButton;

    public function __construct()
    {
        $this->keypad = [[1, 2, 3], [4, 5, 6], [7, 8, 9]];
        $this->currentButton = [1, 1];
    }

    /**
     * If possible, move current button in the given direction. If not possible,
     * does nothing.
     *
     * @param string $direction The direction to move to.
     */
    public function moveCurrentButton(string $direction) : void
    {
        if (!in_array($direction, ['U', 'D', 'L', 'R'])) {
            throw new InvalidArgumentException("Invalid direction.");
        }

        switch ($direction) {
            case 'U':
                $this->moveCurrentButtonUp();
                break;
            case 'D':
                $this->moveCurrentButtonDown();
                break;
            case 'L':
                $this->moveCurrentButtonLeft();
                break;
            case 'R':
                $this->moveCurrentButtonRight();
                break;
        }
    }

    /**
     * Get the current button symbol.
     *
     * @return string The current button symbol.
     */
    public function getCurrentButton() : string
    {
        return $this->keypad
            [$this->currentButton[0]]
            [$this->currentButton[1]];
    }

    /**
     * If possible, move current button up. If not possible, does nothing.
     */
    protected function moveCurrentButtonUp() : void
    {
        $tryButton = [
            $this->currentButton[0] - 1,
            $this->currentButton[1]
        ];

        $this->moveCurrentButtonTo($tryButton[0], $tryButton[1]);
    }

    /**
     * If possible, move current button down. If not possible, does nothing.
     */
    protected function moveCurrentButtonDown() : void
    {
        $tryButton = [
            $this->currentButton[0] + 1,
            $this->currentButton[1]
        ];

        $this->moveCurrentButtonTo($tryButton[0], $tryButton[1]);
    }

    /**
     * If possible, move current button left. If not possible, does nothing.
     */
    protected function moveCurrentButtonLeft() : void
    {
        $tryButton = [
            $this->currentButton[0],
            $this->currentButton[1] - 1
        ];

        $this->moveCurrentButtonTo($tryButton[0], $tryButton[1]);
    }

    /**
     * If possible, move current button right. If not possible, does nothing.
     */
    protected function moveCurrentButtonRight() : void
    {
        $tryButton = [
            $this->currentButton[0],
            $this->currentButton[1] + 1
        ];

        $this->moveCurrentButtonTo($tryButton[0], $tryButton[1]);
    }

    /**
     * If possible, move current button to the designated position. If not
     * possible, does nothing.
     */
    protected function moveCurrentButtonTo(int $newY, int $newX) : void
    {
        if (isset($this->keypad[$newY][$newX])) {
            $this->currentButton = [$newY, $newX];
        }
    }
}
