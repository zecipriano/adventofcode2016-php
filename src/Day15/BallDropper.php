<?php

namespace AdventOfCode2016\Day15;

use AdventOfCode2016\Day15\DiscSet;

class BallDropper
{
    const SLOT = 0;

    public function __construct(DiscSet $discSet)
    {
        $this->discSet = $discSet;
    }

    /**
     * Drop balls until one of them passes all the discs.
     *
     * @return int The ID of the first ball to pass all the discs.
     */
    public function dropBalls() : int
    {
        $tick = 0;
        $balls = [];
        $levels = $this->discSet->getLevelsN();

        while (true) {
            $tick++;
            $this->discSet->tick();
            $balls[$tick -1] = 1;

            foreach ($balls as $id => $ballLevel) {
                if ($this->discSet->getDiscPosition($ballLevel) == self::SLOT) {
                    // Ball passed the disc at $ballLevel.
                    $balls[$id]++;

                    if ($balls[$id] > $levels) {
                        // Ball passed all the discs.
                        return $id;
                    }
                } else {
                    // Ball bounces away.
                    unset($balls[$id]);
                }
            }
        }
    }
}
