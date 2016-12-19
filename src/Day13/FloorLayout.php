<?php

namespace AdventOfCode2016\Day13;

class FloorLayout
{
    protected $seed;
    protected $visited;

    public function __construct(int $seed)
    {
        $this->seed = $seed;
    }

    /**
     * Check if a given coordenate is an open space.
     *
     * @param  array $coordinates The coordinate.
     * @return bool               Whether it's a open space.
     */
    public function isOpenSpace(array $coordinates) : bool
    {
        $x = $coordinates[0];
        $y = $coordinates[1];

        if ($x < 0 || $y < 0) {
            return false;
        }

        $decimal = $x*$x + 3*$x + 2*$x*$y + $y + $y*$y + $this->seed;
        $binary = decbin($decimal);

        $bitsArray = str_split($binary);
        $bitsSum = array_sum($bitsArray);

        return $bitsSum % 2 ? false : true;
    }

    /**
     * Returns the minimum number of steps needed to go from the starting
     * coordinate to the ending coordinate.
     * .
     * @param  array    $startCoordindate The starting coordinate.
     * @param  array    $endCoordinate    The ending coordinate.
     * @return int|null                   The number of steps (or null if not
     *                                    reachable).
     */
    public function shortestPath(
        array $startCoordindate,
        array $endCoordinate
    ) : ?int {
        $pathLenght = 0;
        $currentCoordinates[] = $startCoordindate;

        $endX = $endCoordinate[0];
        $endY = $endCoordinate[1];

        if ($endCoordinate == $startCoordindate) {
            return $pathLenght;
        }

        while (true) {
            $pathLenght++;
            $nextCoordinates = [];

            foreach ($currentCoordinates as $coordinate) {
                $nextCoordinates = array_merge($nextCoordinates, $this->expand($coordinate));
            }

            foreach ($nextCoordinates as $coordinate) {
                $x = $coordinate[0];
                $y = $coordinate[1];

                if ($x === $endX && $y === $endY) {
                    return $pathLenght;
                }
            }

            if (count($nextCoordinates) === 0) {
                return null;
            }

            $currentCoordinates = $nextCoordinates;
        }
    }

    /**
     * Get the coordinates that can be reached, but not yet visited, from the
     * given coordinate.
     *
     * @param  array $coordinate The coordinate.
     * @return array             An array with the reachable coordinates.
     */
    public function expand(array $coordinate) : array
    {
        $expanded = [];

        // North
        $north = [$coordinate[0], $coordinate[1] - 1];
        if ($this->isOpenSpace($north) && $this->unvisited($north)) {
            $this->visited[$north[0]][$north[1]] = 1;
            $expanded[] = $north;
        }

        // South
        $south = [$coordinate[0], $coordinate[1] + 1];
        if ($this->isOpenSpace($south) && $this->unvisited($south)) {
            $this->visited[$south[0]][$south[1]] = 1;
            $expanded[] = $south;
        }

        // West
        $west = [$coordinate[0] + 1, $coordinate[1]];
        if ($this->isOpenSpace($west) && $this->unvisited($west)) {
            $this->visited[$west[0]][$west[1]] = 1;
            $expanded[] = $west;
        }

        // East
        $east = [$coordinate[0] - 1, $coordinate[1]];
        if ($this->isOpenSpace($east) && $this->unvisited($east)) {
            $this->visited[$east[0]][$east[1]] = 1;
            $expanded[] = $east;
        }

        return $expanded;
    }

    /**
     * Checks if a given coordinate is still unvisited. If unvisited marks it
     * as visited before returning.
     *
     * @param  array $coordinate The coordinate to check.
     * @return bool              Whether it is unvisited.
     */
    public function unvisited(array $coordinate) : bool
    {
        $x = $coordinate[0];
        $y = $coordinate[1];

        if (isset($this->visited[$x][$y])) {
            return false;
        }

        return true;
    }
}
