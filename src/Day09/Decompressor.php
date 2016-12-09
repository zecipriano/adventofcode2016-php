<?php

namespace AdventOfCode2016\Day09;

class Decompressor
{
    /**
     * Decompresses the given string.
     *
     * @param  string $string The string to decompress.
     *
     * @return string         The decompressed string.
     */
    public function decompress(string $string) : string
    {
        $stringLength = strlen($string);
        $index = 0;
        $decompressedString = "";

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

                // Add the resulting substring to the decompressed string.
                $subString = substr($string, $index, $nChars);
                $decompressedString .= str_repeat($subString, $nRepetitions);

                // Jump the index to the end of the repeated substring and
                // continue.
                $index += $nChars;
                continue;
            }

            // If it is a regular char just add it to the decompressed string.
            $decompressedString .= $string[$index];
            $index++;
        }

        return $decompressedString;
    }

    /**
     * Decompresses the given string and returns the lenght of the given string.
     *
     * @param  string $string The string to decompress.
     * @return int            The length of the decompressed string.
     */
    public function decompressedLength(string $string) : int
    {
        $decompressedString = $this->decompress($string);
        return strlen($decompressedString);
    }
}
