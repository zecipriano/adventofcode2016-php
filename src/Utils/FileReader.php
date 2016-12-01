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
}
