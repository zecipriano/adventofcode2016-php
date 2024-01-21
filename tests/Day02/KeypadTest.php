<?php

namespace Tests\Day02;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day02\NormalKeypad;
use AdventOfCode2016\Day02\AlternativeKeypad;

class KeypadTest extends TestCase
{
    public function testNormalKeypad(): void
    {
        $keypad = new NormalKeypad();
        $keypad->moveCurrentButton('U');
        $keypad->moveCurrentButton('L');
        $keypad->moveCurrentButton('L');

        $this->assertEquals('1', $keypad->getCurrentButton());

        $keypad->moveCurrentButton('R');
        $keypad->moveCurrentButton('R');
        $keypad->moveCurrentButton('D');
        $keypad->moveCurrentButton('D');
        $keypad->moveCurrentButton('D');

        $this->assertEquals('9', $keypad->getCurrentButton());

        $keypad->moveCurrentButton('L');
        $keypad->moveCurrentButton('U');
        $keypad->moveCurrentButton('R');
        $keypad->moveCurrentButton('D');
        $keypad->moveCurrentButton('L');

        $this->assertEquals('8', $keypad->getCurrentButton());

        $keypad->moveCurrentButton('U');
        $keypad->moveCurrentButton('U');
        $keypad->moveCurrentButton('U');
        $keypad->moveCurrentButton('U');
        $keypad->moveCurrentButton('D');

        $this->assertEquals('5', $keypad->getCurrentButton());
    }

    public function testAlternativeKeypad(): void
    {
        $keypad = new AlternativeKeypad();
        $keypad->moveCurrentButton('U');
        $keypad->moveCurrentButton('L');
        $keypad->moveCurrentButton('L');

        $this->assertEquals('5', $keypad->getCurrentButton());

        $keypad->moveCurrentButton('R');
        $keypad->moveCurrentButton('R');
        $keypad->moveCurrentButton('D');
        $keypad->moveCurrentButton('D');
        $keypad->moveCurrentButton('D');

        $this->assertEquals('D', $keypad->getCurrentButton());

        $keypad->moveCurrentButton('L');
        $keypad->moveCurrentButton('U');
        $keypad->moveCurrentButton('R');
        $keypad->moveCurrentButton('D');
        $keypad->moveCurrentButton('L');

        $this->assertEquals('B', $keypad->getCurrentButton());

        $keypad->moveCurrentButton('U');
        $keypad->moveCurrentButton('U');
        $keypad->moveCurrentButton('U');
        $keypad->moveCurrentButton('U');
        $keypad->moveCurrentButton('D');

        $this->assertEquals('3', $keypad->getCurrentButton());
    }
}
