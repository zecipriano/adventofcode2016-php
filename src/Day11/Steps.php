<?php

namespace AdventOfCode2016\Day11;

class Steps
{
    use ArrangementIdentifier;

    protected array $previousArrangements;

    public function __construct()
    {
        $this->previousArrangements = [];
    }

    /**
     * Move the objects until they are all in the top floor.
     *
     * @return int|null The number of moves needed to put all objects on the top
     *                  floor. Null if not possible.
     */
    public function move(array $initialArrangement): ?int
    {
        $depth = 0;
        $arrangementManager = new ArrangementManager();
        $currentArrangements = [$initialArrangement];
        $arrangementID = $this->identifier($initialArrangement);
        $this->previousArrangements[$arrangementID] = 1;

        while (true) {
            $nextArrangements = [];
            $depth++;

            foreach ($currentArrangements as $arrangement) {
                $possibleArrangements = $arrangementManager->nextPossibleArrangements($arrangement);

                foreach ($possibleArrangements as $possibleArrangement) {
                    if ($this->isNewArrangement($possibleArrangement)) {
                        $nextArrangements[] = $possibleArrangement;

                        if ($arrangementManager->allObjectsOnTopFloor($possibleArrangement)) {
                            return $depth;
                        }
                    }
                }
            }

            if (! $nextArrangements) {
                return null;
            }

            $currentArrangements = $nextArrangements;
        }
    }

    /**
     * Checks if it's the first time that a given arrangement appears.
     *
     * @param array $arrangement The arrangement.
     *
     * @return bool Whether it is the first time the arrangement appears.
     */
    public function isNewArrangement(array $arrangement): bool
    {
        $arrangementID = $this->identifier($arrangement);

        if (! array_key_exists($arrangementID, $this->previousArrangements)) {
            $this->previousArrangements[$arrangementID] = 1;
            return true;
        }

        return false;
    }
}
