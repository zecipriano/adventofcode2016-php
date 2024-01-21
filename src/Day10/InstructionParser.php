<?php

namespace AdventOfCode2016\Day10;

class InstructionParser
{
    /**
     * Parse a string with an instruction to an associative array.
     *
     * @param string $string The string with the instruction.
     *
     * @return array          An array with the instruction components.
     */
    public function parse(string $string): array
    {
        $regex = '/value\s([0-9]+).*bot\s([0-9]+)/';
        preg_match($regex, $string, $matches);

        if (count($matches)) {
            return ['type' => 'value', 'value' => $matches[1], 'bot' => $matches[2]];
        }

        $regex = '/([0-9]+).*(bot|output)\s([0-9]+).*(bot|output)\s([0-9]+)/';
        preg_match($regex, $string, $matches);

        if (count($matches)) {
            return [
                'type' => 'gives',
                'originBot' => (int) $matches[1],
                'low' => [$matches[2], (int) $matches[3]],
                'high' => [$matches[4], (int) $matches[5]],
            ];
        }

        return ['type' => 'invalid'];
    }
}
