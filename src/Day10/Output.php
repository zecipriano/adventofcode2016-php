<?php

namespace AdventOfCode2016\Day10;

use AdventOfCode2016\Day10\Receiver;

class Output implements Receiver
{
    protected $receivedValues;
    public $name;

    public function __construct(string $name = 'unnamed output')
    {
        $this->receivedValues = [];
        $this->name = $name;
    }

    /**
     * Receives a value.
     *
     * @param int $value The value received.
     */
    public function receivesValue(int $value) : void
    {
        array_push($this->receivedValues, $value);
    }

    /**
     * Returns the array of received values.
     *
     * @return array The array of received values.
     */
    public function getReceivedValues() : array
    {
        return $this->receivedValues;
    }

    /**
     * Returns a string describing the output. Includes the name and the values.
     *
     * @return string A string describing the output.
     */
    public function describe() : string
    {
        return $this->name . " [" . implode(", ", $this->receivedValues) . "]";
    }
}
