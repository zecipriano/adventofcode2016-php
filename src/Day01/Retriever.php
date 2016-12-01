<?php

namespace AdventOfCode2016\Day01;

use AdventOfCode2016\Day01\Direction;

class Retriever
{
    protected $direction;
    protected $position;

    public function __construct()
    {
        $this->direction = new Direction();
        $this->position = [0, 0];
    }

    /**
     * Turn right or left and move $blocks block in that direction.
     *
     * @param  string $direction The direction to turn to (right or left).
     * @param  int    $blocks    The amount of blocks to move.
     *
     * @return void
     */
    public function move(string $direction, int $blocks)
    {
        if (!in_array($direction, ["L", "R"])) {
            throw new InvalidArgumentException("Invalid direction.");
        }

        if ($direction === "L") {
            $this->direction->turnLeft();
        } else {
            $this->direction->turnRight();
        }

        $this->go($blocks);
    }

    /**
     * Get the distance, relative to the origin (0, 0).
     *
     * @return int The distance, in blocks, relative to the origin.
     */
    public function getDistance() : int
    {
        return abs($this->position[0]) + abs($this->position[1]);
    }

    /**
     * Move in the direction that the retriever is turned to.
     *
     * @param  int    $blocks The number of blocks to move.
     *
     * @return void
     */
    protected function go(int $blocks)
    {
        switch ($this->direction->get()) {
            case "N":
                $this->position[0] += $blocks;
                break;
            case "S":
                $this->position[0] -= $blocks;
                break;
            case "E":
                $this->position[1] += $blocks;
                break;
            case "W":
                $this->position[1] -= $blocks;
                break;
        }
    }
}
