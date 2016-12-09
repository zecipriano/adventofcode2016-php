<?php

namespace AdventOfCode2016\Day02;

use AdventOfCode2016\Day02\Keypad;

class AlternativeKeypad extends Keypad
{
    public function __construct()
    {
        $this->keypad = [
            [null, null, '1', null, null],
            [null, '2',  '3', '4',  null],
            ['5',  '6',  '7', '8',  '9'],
            [null, 'A',  'B', 'C',  null],
            [null, null, 'D', null, null],
        ];
        $this->currentButton = [2, 0];
    }
}
