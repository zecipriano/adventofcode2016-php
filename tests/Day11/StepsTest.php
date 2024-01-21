<?php

namespace Tests\Day11;

use PHPUnit\Framework\TestCase;

use AdventOfCode2016\Day11\Steps;

class StepsTest extends TestCase
{
    public function testItCalculatesTheNeededMovesCorrectly(): void
    {
        $steps = new Steps();
        $moves = $steps->move(['elevator' => 0, 'objects' => [1, 0, 2, 0]]);
        $this->assertEquals(11, $moves);
    }
}
