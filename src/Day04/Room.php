<?php

namespace AdventOfCode2016\Day04;

class Room
{
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

    public function valCheckSum(string $name, string $checksum) : bool
    {
        if (strcmp($this->calcChecksum($name), $checksum) === 0) {
            return true;
        }

        return false;
    }

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
