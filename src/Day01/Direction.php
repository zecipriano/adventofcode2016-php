<?php

namespace AdventOfCode2016\Day01;

use InvalidArgumentException;

class Direction
{
    protected string $currentDirection;

    public function __construct()
    {
        $this->currentDirection = "N";
    }

    public function turnLeft(): string
    {
        switch ($this->currentDirection) {
            case "N":
                $this->set("W");
                break;
            case "W":
                $this->set("S");
                break;
            case "S":
                $this->set("E");
                break;
            case "E":
                $this->set("N");
                break;
        }

        return $this->currentDirection;
    }

    public function turnRight(): string
    {
        switch ($this->currentDirection) {
            case "N":
                $this->set("E");
                break;
            case "E":
                $this->set("S");
                break;
            case "S":
                $this->set("W");
                break;
            case "W":
                $this->set("N");
                break;
        }

        return $this->currentDirection;
    }

    /**
     * Set the direction to the given $newDirection. Fails if $newDirection is
     * not a valid value.
     */
    public function set(string $newDirection): string
    {
        if (! in_array($newDirection, ["N", "S", "E", "W"])) {
            throw new InvalidArgumentException("Invalid direction.");
        }

        $this->currentDirection = $newDirection;

        return $this->currentDirection;
    }

    /**
     * Get the current direction.
     *
     * @return string The current direction
     */
    public function get(): string
    {
        return $this->currentDirection;
    }
}
