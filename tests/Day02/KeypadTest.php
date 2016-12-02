<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day02\Keypad;

class KeypadTest extends TestCase
{
    protected $keypad;

    protected function setUp()
    {
        $this->keypad = new Keypad();
    }

    public function testKeypad1()
    {
        $this->keypad->move("U");
        $this->keypad->move("L");
        $this->keypad->move("L");

        $this->assertEquals(1, $this->keypad->getCurrentButton());

        $this->keypad->move("R");
        $this->keypad->move("R");
        $this->keypad->move("D");
        $this->keypad->move("D");
        $this->keypad->move("D");

        $this->assertEquals(9, $this->keypad->getCurrentButton());

        $this->keypad->move("L");
        $this->keypad->move("U");
        $this->keypad->move("R");
        $this->keypad->move("D");
        $this->keypad->move("L");

        $this->assertEquals(8, $this->keypad->getCurrentButton());

        $this->keypad->move("U");
        $this->keypad->move("U");
        $this->keypad->move("U");
        $this->keypad->move("U");
        $this->keypad->move("D");

        $this->assertEquals(5, $this->keypad->getCurrentButton());
    }
}
