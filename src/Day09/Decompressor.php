<?php

namespace AdventOfCode2016\Day09;

class Decompressor
{
    /**
     * Returns the lenght of the decompressed string.
     *
     * @param  string  $string    The string to decompress.
     * @param  boolean $recursive Whether to decompress the decompressed
     *                            substrings.
     *
     * @return int                The lenght of the decompressed string.
     */
    public function decompressedLength(
        string $string,
        bool $recursive = false
    ) : int {
        $stringLength = strlen($string);
        $index = 0;
        $decompressedLenght = 0;

        while ($index < $stringLength) {
            // If the current char is a '(' we are in the beginning of a marker.
            if ($string[$index] === '(') {
                // Initialize the marker and jump the opening '('.
                $marker = "";
                $index++;

                // Get the marker content.
                while ($string[$index] !== ')') {
                    $marker .= $string[$index];
                    $index++;
                }

                // Jump the closing ')'.
                $index++;

                // Get the marker values.
                $marker = explode('x', $marker);
                $nChars = $marker[0];
                $nRepetitions = $marker[1];

                // Add the resulting substring length to the decompressed string
                // lenght.
                if ($recursive) {
                    $subString = substr($string, $index, $nChars);
                    $subLength = $this->decompressedLength($subString, true);
                    $decompressedLenght += $nRepetitions * $subLength;
                } else {
                    $decompressedLenght += $nRepetitions * $nChars;
                }

                // Jump the index to the end of the repeated substring and
                // continue.
                $index += $nChars;
                continue;
            }

            // If it is a regular char just add it to the decompressed string.
            $decompressedLenght++;
            $index++;
        }

        return $decompressedLenght;
    }
}
