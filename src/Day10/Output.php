<?php

namespace AdventOfCode2016\Day10;

class Output implements Receiver
{
    public string $name;
    protected array $receivedValues;

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
    public function receivesValue(int $value): void
    {
        $this->receivedValues[] = $value;
    }

    /**
     * Returns the array of received values.
     *
     * @return array The array of received values.
     */
    public function getReceivedValues(): array
    {
        return $this->receivedValues;
    }

    /**
     * Returns a string describing the output. Includes the name and the values.
     *
     * @return string A string describing the output.
     */
    public function describe(): string
    {
        return $this->name . " [" . implode(", ", $this->receivedValues) . "]";
    }
}
