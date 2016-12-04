<?php

namespace AdventOfCode2016\Day04;

class Room
{
    /**
     * Calculates the checksum for the given room $name.
     *
     * @param  string $name The room name
     *
     * @return string       The checksum
     */
    public function calcChecksum(string $name) : string
    {
        $name = str_split($name);
        $charCounts = [];

        foreach ($name as $char) {
            if ($char === '-') {
                continue;
            }

            if (!isset($charCounts[$char])) {
                $charCounts[$char] = 0;
            }

            $charCounts[$char]++;
        }

        return $this->getChecksum($charCounts);
    }

    /**
     * Checks is the given $checksum is valid for a given room $name.
     *
     * @param  string $name     The room name
     * @param  string $checksum The checksum to test
     *
     * @return bool             Whether the checksum is valid or not
     */
    public function valCheckSum(string $name, string $checksum) : bool
    {
        if (strcmp($this->calcChecksum($name), $checksum) === 0) {
            return true;
        }

        return false;
    }

    /**
     * Get the checksum from an array with the counts of each char. The checksum
     * is a string with the 5 most common chars. First ordered by count then
     * alphabetically.
     *
     * @param  array  $charCounts An associative array with the char counts
     *
     * @return string             The string
     */
    protected function getChecksum(array $charCounts) : string
    {
        array_multisort(
            array_values($charCounts),
            SORT_DESC,
            SORT_NUMERIC,
            array_keys($charCounts),
            SORT_ASC,
            SORT_STRING,
            $charCounts
        );

        return substr(implode(array_keys($charCounts)), 0, 5);
    }
}
