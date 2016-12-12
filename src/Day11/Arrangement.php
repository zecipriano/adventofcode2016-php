<?php

namespace AdventOfCode2016\Day11;

use InvalidArgumentException;
use Kieranajp\Combinator\Combinator;

class Arrangement
{
    const MIN_FLOOR = 0;
    const MAX_FLOOR = 3;

    /**
     * The elevator floor.
     * @var int
     */
    protected $elevatorFloor;

    /**
     * The objects representations. The generators floors are represented by the
     * odd indexes of the array and the microchips floors by the even indexes.
     * @var array
     */
    protected $objects;

    public function __construct(
        int $elevatorFloor = null,
        array $objects = null
    ) {
        $constructed = false;

        if ($elevatorFloor !== null &&
            $objects &&
            !$this->set($elevatorFloor, $objects)
        ) {
                throw new InvalidArgumentException('Invalid arguments.');
        }
    }

    /**
     * Set the elevator floor and object configuration.
     *
     * @param  int   $elevatorFloor The elevator floor.
     * @param  array $objects       The object configuration.
     * @return bool                 Whether the params are valid and were set.
     */
    public function set(int $elevatorFloor, array $objects) : bool
    {
        if ($this->isPossible($objects) &&
            $elevatorFloor >= self::MIN_FLOOR &&
            $elevatorFloor <= self::MAX_FLOOR
        ) {
            $this->elevatorFloor = $elevatorFloor;
            $this->objects = $objects;

            return true;
        }

        return false;
    }

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
    protected function floorHasGenerators(
        int $floor,
        ?array $objects = null
    ) : bool {
        $objects = $objects ?? $this->objects;
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
    public function nextPossibleArrangements() : array
    {
        $nextArrangements = [];
        $nextPossibleMinFloor = self::MIN_FLOOR;

        // Get the objects on the same floor as the elevator.
        $objsCurrentFloor = array_filter($this->objects, function ($floor) {
            return $this->elevatorFloor === $floor;
        });

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
            if ($this->elevatorFloor > self::MIN_FLOOR &&
                $this->elevatorFloor > $this->minOccupiedFloor()
            ) {
                $down = $this->objects;

                foreach ($objectsToMove as $object) {
                    $down[$object]--;
                }

                if ($this->isPossible($down)) {
                    $nextPossibleMinFloor = max(
                        min($down),
                        $nextPossibleMinFloor
                    );
                    $nextArrangements[] = new Arrangement(
                        $this->elevatorFloor - 1,
                        $down
                    );
                }
            }

            // If the elevator is below the top floor, then it can go up.
            if ($this->elevatorFloor < self::MAX_FLOOR) {
                $up = $this->objects;

                foreach ($objectsToMove as $object) {
                    $up[$object]++;
                }

                if ($this->isPossible($up)) {
                    $nextPossibleMinFloor = max(
                        min($up),
                        $nextPossibleMinFloor
                    );
                    $nextArrangements[] = new Arrangement(
                        $this->elevatorFloor + 1,
                        $up
                    );
                }
            }
        }

        // Filter out all the arrangements that have objects below the possible
        // minimum floor.
        $nextArrangements = array_filter(
            $nextArrangements,
            function ($arr) use ($nextPossibleMinFloor) {
                return $arr->minOccupiedFloor() >= $nextPossibleMinFloor;
            }
        );

        return array_values($nextArrangements);
    }

    /**
     * Returns the lowest floor that contains any object.
     *
     * @return int The lowest floor that contains any object.
     */
    public function minOccupiedFloor() : int
    {
        return $this->objects ? min($this->objects) : self::MIN_FLOOR;
    }

    /**
     * Return a string representation of the current arrangement.
     *
     * @return string The string representation of the current arrangement.
     */
    public function __toString() : string
    {
        $string = "[E: " . $this->elevatorFloor . "]";

        foreach ($this->objects as $value) {
            $string .= " " . $value;
        }

        return $string;
    }

    /**
     * Compares the current arrangement with the given arrangement.
     *
     * @param  Arrangement $arrangement The arrangement to compare with.
     * @return bool                     Whether if the arrangements are equal.
     */
    public function isEqual(Arrangement $arrangement) : bool
    {
        $equalObjects = $this->objects == $arrangement->getObjects();

        return $this->elevatorFloor === $arrangement->getElevatorFloor() &&
               $equalObjects;
    }

    /**
     * Get the objects.
     *
     * @return array The objects.
     */
    public function getObjects() : array
    {
        return $this->objects;
    }

    /**
     * Get the elevator floor.
     *
     * @return int The elevator floor.
     */
    public function getElevatorFloor() : int
    {
        return $this->elevatorFloor;
    }

    /**
     * Checks if all objects are on the top floor.
     *
     * @return bool Whether the objects are all on the top floor.
     */
    public function allObjectsOnTopFloor() : bool
    {
        foreach ($this->objects as $floor) {
            if ($floor !== self::MAX_FLOOR) {
                return false;
            }
        }

        return true;
    }
}
