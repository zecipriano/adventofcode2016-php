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

    /**
     * Find the time to drop the ball.
     *
     * @return int The time to drop the ball.
     */
    public function findDropTime() : int
    {
        $needed = $this->getNeededDiscPosition();
        $tick = 0;

        while (true) {
            if ($this->isAtNeededPosition($needed)) {
                return $tick;
            }

            $tick++;
            $this->tick();
        }

        return 1;
    }

    /**
     * Calculate the position in which each of the discs should be at the time
     * of the ball dropping in order to it drop successfully through the discs.
     *
     * @return array The positions of each disc.
     */
    protected function getNeededDiscPosition() : array
    {
        foreach ($this->discSet as $id => $disc) {
            $needed[$id] = ($disc['nPositions'] - 1) -
                           (($id - 1) % $disc['nPositions']);
        }

        return $needed;
    }

    /**
     * Compare the current disc positions with the needed position.
     *
     * @param  array $needed The needed position.
     * @return bool          Whether the discs are in the needed position.
     */
    protected function isAtNeededPosition(array $needed) : bool
    {
        foreach ($this->discSet as $id => $disc) {
            if ($this->discSet[$id]['position'] !== $needed[$id]) {
                return false;
            }
        }

        return true;
    }
}
