<?php

namespace AdventOfCode2016\Day10;

interface Receiver
{
    /**
     * Receives a values and adds it to the values array.
     *
     * @param int $value The value to receive.
     */
    public function receivesValue(int $value): void;

    /**
     * Return a string describing the object.
     *
     * @return string The description of the object.
     */
    public function describe(): string;
}
