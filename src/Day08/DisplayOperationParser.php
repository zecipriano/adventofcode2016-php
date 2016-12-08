<?php

namespace AdventOfCode2016\Day08;

class DisplayOperationParser
{
    /**
     * Parse the operation from the given string.
     *
     * @param  string $operation The string describing the operation.
     * @return array             An array with the command and arguments.
     */
    public function parse(string $operation) : array
    {
        // Get command
        $regex = '/rect|rotate row|rotate column/';
        preg_match($regex, $operation, $matches);
        $command = $matches[0];

        // Get arguments
        $regex = '/([0-9]+)(x|\sby\s)([0-9]+)/';
        preg_match_all($regex, $operation, $matches);
        $arg1 = $matches[1][0];
        $arg2 = $matches[3][0];

        return [$command, intval($arg1), intval($arg2)];
    }
}
