<?php

namespace AdventOfCode2016\Day02;

use AdventOfCode2016\Day02\Keypad;

class NormalKeypad extends Keypad
{
    public function __construct()
    {
        $this->keypad = [[1, 2, 3], [4, 5, 6], [7, 8, 9]];
        $this->currentButton = [1, 1];
    }
}
