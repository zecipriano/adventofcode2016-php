<?php

namespace AdventOfCode2016\Day08;

class Display
{
    protected array $display;

    public function __construct(int $height, int $width)
    {
        $this->display = array_fill(0, $height, array_fill(0, $width, 0));
    }

    /**
     * Turns on a rectangle of lights in the top left corner.
     *
     * @param int $height The height of the rectangle.
     * @param int $width The width of the rectangle.
     */
    public function rect(int $height, int $width): void
    {
        if ($height > count($this->display) ||
            $width > count($this->display[0])) {
            return;
        }

        for ($i = 0; $i < $height; $i++) {
            for ($j = 0; $j < $width; $j++) {
                $this->turnOn($i, $j);
            }
        }
    }

    /**
     * Rotate a column by the given $amount.
     *
     * @param int $column The column to rotate.
     * @param int $amount The amount to rotate.
     */
    public function rotateColumn(int $column, int $amount): void
    {
        // Get the column to rotate
        $tmpColumn = array_column($this->display, $column);

        $this->rotateArray($tmpColumn, $amount);

        $iMax = count($tmpColumn);

        // Set the column back in the display
        for ($i = 0; $i < $iMax; $i++) {
            $this->display[$i][$column] = $tmpColumn[$i];
        }
    }

    /**
     * Rotate a row by the given $amount.
     *
     * @param int $row The row to rotate.
     * @param int $amount The amount to rotate.
     */
    public function rotateRow(int $row, int $amount): void
    {
        $this->rotateArray($this->display[$row], $amount);
    }

    /**
     * Turn on the pixel identified by $x and $y.
     *
     * @param int $y The y coordinate.
     * @param int $x The x coordinate.
     */
    protected function turnOn(int $y, int $x): void
    {
        if ($y > count($this->display) || $x > count($this->display[0])) {
            return;
        }

        $this->display[$y][$x] = 1;
    }

    /**
     * Rotate an array by the given amount.
     *
     * @param array $array The array to rotate.
     * @param int $amount The amount to rotate.
     */
    protected function rotateArray(array &$array, int $amount): void
    {
        for ($i = 0; $i < $amount; $i++) {
            $el = array_pop($array);
            array_unshift($array, $el);
        }
    }

    /**
     * Returns the total amount of pixels.
     *
     * @return int The total of pixels.
     */
    public function totalPixels(): int
    {
        return count($this->display) * count($this->display[0]);
    }

    /**
     * Returns the number of lit pixels.
     *
     * @return int The number of lit pixels.
     */
    public function litPixels(): int
    {
        $litPixels = 0;

        array_walk_recursive(
            $this->display,
            static function ($pixel) use (&$litPixels) {
                $litPixels += $pixel;
            }
        );

        return $litPixels;
    }

    /**
     * Checks if a given pixel is lit.
     *
     * @param int $y The y coordinate of the pixel.
     * @param int $x The x coordinate of the pixel.
     *
     * @return bool    Whether the pixel is list or not.
     */
    public function isLit(int $y, int $x): bool
    {
        return (bool) $this->display[$y][$x];
    }

    /**
     * Echoes the display.
     */
    public function showDisplay(): void
    {
        echo "\n--- DISPLAY ---\n\n";

        foreach ($this->display as $line) {
            foreach ($line as $pixel) {
                echo $pixel ? "#" : ".";
            }
            echo "\n";
        }

        echo "\n--- ------- ---\n";
    }

    /**
     * Returns the display.
     *
     * @return array The display.
     */
    public function getDisplay(): array
    {
        return $this->display;
    }
}
