<?php

namespace tests\Day11;

use PHPUnit\Framework\TestCase;

use AdventOfCode2016\Day11\Steps;

class StepsTest extends TestCase
{
    public function testItCalculatesTheNeededMovesCorrectly()
    {
        $steps = new Steps(0, [1, 0, 2, 0]);
        $moves = $steps->move();
        $this->assertEquals(11, $moves);
    }
}
