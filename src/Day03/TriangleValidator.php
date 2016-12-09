<?php

namespace AdventOfCode2016\Day03;

class TriangleValidator
{
    /**
     * Checks if the given side measurements can describe a valid triangle. In a
     * valid triangle, the sum of any two sides must be larger than the
     * remaining side.
     *
     * @param  int  $side1 Side 1 size.
     * @param  int  $side2 Side 2 size.
     * @param  int  $side3 Side 3 size.
     *
     * @return bool        Whether the sides belong to valid triangle.
     */
    public function validate(int $side1, int $side2, int $side3) : bool
    {
        $check1 = $side1 + $side2 > $side3;
        $check2 = $side1 + $side3 > $side2;
        $check3 = $side2 + $side3 > $side1;

        return $check1 && $check2 && $check3;
    }
}
