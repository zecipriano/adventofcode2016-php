<?php

namespace AdventOfCode2016\Day01;

use InvalidArgumentException;

class Retriever
{
    protected Direction $direction;
    protected array $position;
    protected array $visitedPositions;
    protected ?array $firstVisitedTwicePosition;

    public function __construct()
    {
        $this->direction = new Direction();
        $this->position = [0, 0];
        $this->visitedPositions[0][0] = 1;
        $this->firstVisitedTwicePosition = null;
    }

    /**
     * Turn right or left and move $blocks block in that direction.
     *
     * @param string $direction The direction to turn to (right or left).
     * @param int $blocks The amount of blocks to move.
     */
    public function move(string $direction, int $blocks): void
    {
        if (! in_array($direction, ["L", "R"])) {
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
    public function getDistance(): int
    {
        return abs($this->position[0]) + abs($this->position[1]);
    }

    /**
     * Get the distance, relative to the origin (0, 0), of the first position
     * visited twice.
     *
     * @return int The distance, in blocks, relative to the origin.
     */
    public function getFirstRepeatedDistance(): int
    {
        if ($this->firstVisitedTwicePosition) {
            return abs($this->firstVisitedTwicePosition[0]) +
                abs($this->firstVisitedTwicePosition[1]);
        }

        return 0;
    }

    /**
     * Move in the direction that the retriever is turned to.
     *
     * @param int $blocks The number of blocks to move.
     */
    protected function go(int $blocks): void
    {
        switch ($this->direction->get()) {
            case "N":
                $this->countBlockVisits(
                    $this->position[0],
                    $this->position[1] + 1,
                    $this->position[0],
                    $this->position[1] + $blocks
                );
                $this->position[1] += $blocks;
                break;
            case "S":
                $this->countBlockVisits(
                    $this->position[0],
                    $this->position[1] - 1,
                    $this->position[0],
                    $this->position[1] - $blocks
                );
                $this->position[1] -= $blocks;
                break;
            case "E":
                $this->countBlockVisits(
                    $this->position[0] + 1,
                    $this->position[1],
                    $this->position[0] + $blocks,
                    $this->position[1]
                );
                $this->position[0] += $blocks;
                break;
            case "W":
                $this->countBlockVisits(
                    $this->position[0] - 1,
                    $this->position[1],
                    $this->position[0] - $blocks,
                    $this->position[1]
                );
                $this->position[0] -= $blocks;
                break;
        }
    }

    /**
     * Increments the visit count for each of the positions in the given range.
     *
     * @param int $startX The X coordinate of the starting position.
     * @param int $startY The Y coordinate of the starting position.
     * @param int $endX The X coordinate of the ending position.
     * @param int $endY The Y coordinate of the ending position.
     */
    protected function countBlockVisits(
        int $startX,
        int $startY,
        int $endX,
        int $endY
    ): void {
        for ($x = $startX; $x <= $endX; $x++) {
            for ($y = $startY; $y <= $endY; $y++) {
                if (! isset($this->visitedPositions[$x][$y])) {
                    $this->visitedPositions[$x][$y] = 0;
                }

                $this->visitedPositions[$x][$y]++;

                if (
                    ! $this->firstVisitedTwicePosition &&
                    $this->visitedPositions[$x][$y] === 2
                ) {
                    $this->firstVisitedTwicePosition = [$x, $y];
                }
            }
        }
    }
}
