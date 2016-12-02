<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day02\AlternativeKeypad;

class AlternativeKeypadTest extends TestCase
{
    protected $keypad;

    protected function setUp()
    {
        $this->keypad = new AlternativeKeypad();
    }

    public function testKeypad1()
    {
        $this->keypad->move("U");
        $this->keypad->move("L");
        $this->keypad->move("L");

        $this->assertEquals("5", $this->keypad->getCurrentButton());

        $this->keypad->move("R");
        $this->keypad->move("R");
        $this->keypad->move("D");
        $this->keypad->move("D");
        $this->keypad->move("D");

        $this->assertEquals("D", $this->keypad->getCurrentButton());

        $this->keypad->move("L");
        $this->keypad->move("U");
        $this->keypad->move("R");
        $this->keypad->move("D");
        $this->keypad->move("L");

        $this->assertEquals("B", $this->keypad->getCurrentButton());

        $this->keypad->move("U");
        $this->keypad->move("U");
        $this->keypad->move("U");
        $this->keypad->move("U");
        $this->keypad->move("D");

        $this->assertEquals("3", $this->keypad->getCurrentButton());
    }
}
