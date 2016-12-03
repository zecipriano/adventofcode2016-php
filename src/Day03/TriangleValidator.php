<?php

namespace AdventOfCode2016\Day03;

class TriangleValidator
{
    public function validate(int $side1, int $side2, int $side3) : bool
    {
        $check1 = $side1 + $side2 > $side3;

        $check2 = $side1 + $side3 > $side2;

        $check3 = $side2 + $side3 > $side1;

        return $check1 && $check2 && $check3;
    }
}
