<?php

namespace AdventOfCode2016\Day16;

class Data
{
    /**
     * Get the checksum from a initial state.
     *
     * @param string $inState The initial state.
     * @param int $diskSize The disk size.
     *
     * @return string The checksum.
     */
    public function checkSum(string $inState, int $diskSize): string
    {
        return $this->calcCheckSum($this->fillDisk($inState, $diskSize));
    }

    /**
     * Fill a disk of the given size.
     *
     * @param string $initialState The initial state.
     * @param int $diskSize The disk size.
     *
     * @return string               The string to fill the disk.
     */
    public function fillDisk(string $initialState, int $diskSize): string
    {
        $out = $initialState;

        while (strlen($out) < $diskSize) {
            $out = $this->doubleData($out);
        }

        return substr($out, 0, $diskSize);
    }

    /**
     * Doubles the data size (actually double + one char)
     *
     * @param string $inString The string to double
     *
     * @return string           The doubled string.
     */
    public function doubleData(string $inString): string
    {
        $out = "0";
        $len = strlen($inString);

        for ($i = $len - 1; $i >= 0; $i--) {
            if (strcmp($inString[$i], '1') === 0) {
                $out .= '0';
            } else {
                $out .= '1';
            }
        }

        return $inString . $out;
    }


    /**
     * Calculate the checksum of the string.
     *
     * @param string $string The string.
     *
     * @return string         The checksum.
     */
    public function calcCheckSum(string $string): string
    {
        $checksum = '';

        while (strlen($checksum) % 2 === 0) {
            $checksum = '';
            $len = strlen($string);
            for ($i = 0; $i < $len; $i += 2) {
                if (strcmp($string[$i], $string[$i + 1]) === 0) {
                    $checksum .= '1';
                } else {
                    $checksum .= '0';
                }
            }

            $string = $checksum;
        }

        return $checksum;
    }
}
