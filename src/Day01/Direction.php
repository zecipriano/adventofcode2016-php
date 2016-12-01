<?php

namespace AdventOfCode2016\Day01;

use InvalidArgumentException;

class Direction
{
    protected $currentDirection;

    public function __construct()
    {
        $this->currentDirection = "N";
    }

    /**
     * Turn left.
     *
     * @return The resulting direction after turning.
     */
    public function turnLeft()
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

    /**
     * Turn Right.
     *
     * @return The resulting direction after turning.
     */
    public function turnRight()
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
     *
     * @param string $newDirection The direction to set to.
     *
     * @return string The resulting direction.
     */
    public function set(string $newDirection)
    {
        if (!in_array($newDirection, ["N", "S", "E", "W"])) {
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
    public function get() : string
    {
        return $this->currentDirection;
    }
}
