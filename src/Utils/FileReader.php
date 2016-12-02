<?php

namespace AdventOfCode2016\Utils;

use Exception;

class FileReader
{
    protected $filename;

    public function __construct(string $filename)
    {
        if (!is_readable($filename)) {
            throw new Exception("File not found or not readable.");
        }

        $this->filename = $filename;
    }

    /**
     * Get the content of the file as a string.
     *
     * @return string The content of the file
     */
    public function getString() : string
    {
        $string = trim(file_get_contents($this->filename));
        return $string;
    }

    /**
     * Get the content as an array of strings. Each string is a line.
     *
     * @return array An array of lines.
     */
    public function getArrayOfLines() : array
    {
        $array = file($this->filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        return $array;
    }
}
