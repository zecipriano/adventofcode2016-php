<?php

namespace Tests\Day08;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day08\Display;

class DisplayTest extends TestCase
{
    public function testItInitializesWithTheGivenSizeAndTurnedOff()
    {
        $display = new Display(3, 7);
        $this->assertEquals(21, $display->totalPixels());
        $this->assertEquals(0, $display->litPixels());

        $display->rect(2, 3);
        $this->assertEquals(6, $display->litPixels());

        $display->rotateColumn(1, 1);
        $this->assertEquals(6, $display->litPixels());
        $this->assertFalse($display->isLit(0, 1));
        $this->assertTrue($display->isLit(2, 1));

        $display->rotateRow(0, 4);
        $this->assertEquals(6, $display->litPixels());
        $this->assertFalse($display->isLit(0, 0));
        $this->assertTrue($display->isLit(0, 6));

        $display->rotateColumn(1, 1);
        $this->assertEquals(6, $display->litPixels());
        $this->assertTrue($display->isLit(0, 1));
        $this->assertFalse($display->isLit(1, 1));
    }
}
