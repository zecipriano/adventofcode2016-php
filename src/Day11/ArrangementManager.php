<?php

namespace AdventOfCode2016\Day11;

class ArrangementManager
{
    const MIN_FLOOR = 0;
    const MAX_FLOOR = 3;

    /**
     * Checks if a given object configuration is possible. A configuration is
     * not possible if a disconnected microchip is in the same floor as other
     * generators.
     *
     * @param  array $objects [description]
     * @return bool           [description]
     */
    public function isPossible(array $objects) : bool
    {
        $nObjects = count($objects);

        // For all microchips.
        for ($i = 1; $i < $nObjects; $i += 2) {
            // If the corresponding generator is in a different floor (meaning:
            // the microchip is disconnected).
            if ($objects[$i] !== $objects[$i - 1]) {
                // Check if the current floor has generators.
                if ($this->floorHasGenerators($objects[$i], $objects)) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Checks if the given $floor in the given $objects configuration has
     * generators. If not givent $objects defaults to $this->objects.
     *
     * @param  int    $floor   The floor to check.
     * @param  ?array $objects The objects configuration.
     * @return bool            [description]
     */
    protected function floorHasGenerators(int $floor, array $objects) : bool
    {
        $nObjects = count($objects);

        for ($i = 0; $i < $nObjects; $i += 2) {
            if ($objects[$i] === $floor) {
                return true;
            }
        }

        return false;
    }

    /**
     * Generate the next possible arrangements from the current state.
     *
     * @return array The next possible arrangements.
     */
    public function nextPossibleArrangements(array $arrangement) : array
    {
        $nextArrangements = [];
        $nextPossibleMinFloor = self::MIN_FLOOR;

        // Get the objects on the same floor as the elevator.
        $objsCurrentFloor = array_filter(
            $arrangement['objects'],
            function ($floor) use ($arrangement) {
                return $arrangement['elevator'] === $floor;
            }
        );

        // Get the combinations in wich the objects can be moved.
        $possibleCombinations = [];

        // 1 object at a time.
        foreach (array_keys($objsCurrentFloor) as $index) {
            $possibleCombinations[] = [$index];
        }

        // 2 objects at a time
        if (count($objsCurrentFloor) > 1) {
            $combinator = new Combinator(array_keys($objsCurrentFloor), 2);

            foreach ($combinator as $possibleCombination) {
                $possibleCombinations[] = $possibleCombination;
            }
        }

        // Generate the possible new arrangements (one for the elevator going up
        // and othe for going donw).
        foreach ($possibleCombinations as $objectsToMove) {
            // If the elevator is above the bottom floor and above the first
            // floor that contains a object (there is no point of going
            // below that), then it can go down.
            if ($arrangement['elevator'] > self::MIN_FLOOR &&
                $arrangement['elevator'] > $this->minOccupiedFloor($arrangement['objects'])
            ) {
                $down = $arrangement['objects'];

                foreach ($objectsToMove as $object) {
                    $down[$object]--;
                }

                if ($this->isPossible($down)) {
                    $nextPossibleMinFloor = max(
                        min($down),
                        $nextPossibleMinFloor
                    );
                    $nextArrangements[] = [
                        'elevator' => $arrangement['elevator'] - 1,
                        'objects' => $down
                    ];
                }
            }

            // If the elevator is below the top floor, then it can go up.
            if ($arrangement['elevator'] < self::MAX_FLOOR) {
                $up = $arrangement['objects'];

                foreach ($objectsToMove as $object) {
                    $up[$object]++;
                }

                if ($this->isPossible($up)) {
                    $nextPossibleMinFloor = max(
                        min($up),
                        $nextPossibleMinFloor
                    );
                    $nextArrangements[] = [
                        'elevator' => $arrangement['elevator'] + 1,
                        'objects' => $up
                    ];
                }
            }
        }

        // Filter out all the arrangements that have objects below the possible
        // minimum floor.
        $nextArrangements = array_filter(
            $nextArrangements,
            function ($arr) use ($nextPossibleMinFloor) {
                return $this->minOccupiedFloor($arr['objects']) >= $nextPossibleMinFloor;
            }
        );

        return array_values($nextArrangements);
    }

    /**
     * Returns the lowest floor that contains any object.
     *
     * @return int The lowest floor that contains any object.
     */
    public function minOccupiedFloor(array $objects) : int
    {
        return min($objects);
    }

    /**
     * Checks if all objects are on the top floor.
     *
     * @return bool Whether the objects are all on the top floor.
     */
    public function allObjectsOnTopFloor(array $arrangement) : bool
    {
        foreach ($arrangement['objects'] as $floor) {
            if ($floor !== self::MAX_FLOOR) {
                return false;
            }
        }

        return true;
    }
}
