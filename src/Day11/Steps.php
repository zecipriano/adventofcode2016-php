<?php

namespace AdventOfCode2016\Day11;

use AdventOfCode2016\Day11\Arrangement;

class Steps
{
    protected $initialArrangement;
    protected $previousArrangements;

    public function __construct(int $elevatorFloor, array $objects)
    {
        $this->previousArrangements = [];
        $this->initialArrangement = new Arrangement($elevatorFloor, $objects);
    }

    /**
     * Move the objects until they are all in the top floor.
     *
     * @return int|null The number of moves needed to put all objects on the top
     *                  floor. Null if not possible.
     */
    public function move() : ?int
    {
        $depth = 0;
        $currentArrangements = [$this->initialArrangement];
        $arrangementID = $this->initialArrangement->__toString();
        $this->previousArrangements[] = $arrangementID;

        while (true) {
            $nextArrangements = [];
            $depth++;

            foreach ($currentArrangements as $arrangement) {
                $possibleArrangements = $arrangement->nextPossibleArrangements();

                foreach ($possibleArrangements as $possibleArrangement) {
                    if ($this->isNewArrangement($possibleArrangement, $depth)) {
                        $nextArrangements[] = $possibleArrangement;

                        if ($possibleArrangement->allObjectsOnTopFloor()) {
                            return $depth;
                        }
                    }
                }
            }

            if (!$nextArrangements) {
                return null;
            }

            $currentArrangements = $nextArrangements;
        }
    }

    /**
     * Checks if it's the first time that a given arrangement appears.
     *
     * @param  Arrangement $arrangement The arrangement.
     * @param  int         $depth       The depth of the arrangement.
     * @return bool                     Whether it is the first time the
     *                                  arrangement appears.
     */
    public function isNewArrangement(Arrangement $arrangement) : bool
    {
        $arrangementID = $arrangement->__toString();

        if (!in_array($arrangementID, $this->previousArrangements)) {
            $this->previousArrangements[] = $arrangementID;
            return true;
        }

        return false;
    }
}
