<?php

namespace AdventOfCode2016\Day04;

class RoomStringParser
{
    /**
     * Extract the different values from the input string.
     *
     * @param  string $roomString The input string
     *
     * @return array              An associative array with the extracted values
     */
    public function parse(string $roomString) : array
    {
        $parsedString = [];
        $matches = [];

        // Extract name (everything until the last '-')
        preg_match('/(.+)(?=\-)/', $roomString, $matches);
        $parsedString['name'] = $matches[0];

        // Extract checksum (anything between '[' and ']')
        preg_match('/(?<=\[)(.*)(?=\])/', $roomString, $matches);
        $parsedString['checksum'] = $matches[0];

        // Extract ID (numbers between a '-' and a '[')
        preg_match('/(?<=\-)([0-9]*)(?=\[)/', $roomString, $matches);
        $parsedString['id'] = intval($matches[0]);

        return $parsedString;
    }
}
