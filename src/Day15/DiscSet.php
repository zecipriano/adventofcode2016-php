<?php

namespace AdventOfCode2016\Day15;

class DiscSet
{
    protected $discSet;

    public function __construct(array $discSet)
    {
        $this->discSet = $discSet;
    }

    /**
     * Get the position of the given disc.
     *
     * @param  int $discID The disc to get the position.
     * @return int         The disc position.
     */
    public function getDiscPosition(int $discID) : int
    {
        if (!isset($this->discSet[$discID]['position'])) {
            return -1;
        }

        return $this->discSet[$discID]['position'];
    }

    /**
     * Move all discs one position.
     */
    public function tick() : void
    {
        foreach ($this->discSet as &$disc) {
            $disc['position']++;

            if ($disc['position'] >= $disc['nPositions']) {
                $disc['position'] = 0;
            }
        }
    }

    /**
     * Get the number of levels in the disc set.
     *
     * @return int The number of levels in the disc set.
     */
    public function getLevelsN() : int
    {
        return count($this->discSet);
    }
}
