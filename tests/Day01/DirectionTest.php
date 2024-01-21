<?php

namespace Tests\Day01;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day01\Direction;
use InvalidArgumentException;

class DirectionTest extends TestCase
{
    protected $direction;

    protected function setUp(): void
    {
        $this->direction = new Direction();
    }

    public function testSetDirection()
    {
        $newDirection = $this->direction->set("N");
        $this->assertEquals("N", $newDirection);

        $newDirection = $this->direction->set("S");
        $this->assertEquals("S", $newDirection);

        $newDirection = $this->direction->set("E");
        $this->assertEquals("E", $newDirection);

        $newDirection = $this->direction->set("W");
        $this->assertEquals("W", $newDirection);
    }

    public function testCantSetInvalidDirection()
    {
        $this->expectException(InvalidArgumentException::class);
        $newDirection = $this->direction->set("P");
        $this->assertEquals("N", $newDirection);
    }

    public function testCanTurnLeft()
    {
        $newDirection = $this->direction->turnLeft();
        $this->assertEquals("W", $newDirection);

        $newDirection = $this->direction->turnLeft();
        $this->assertEquals("S", $newDirection);

        $newDirection = $this->direction->turnLeft();
        $this->assertEquals("E", $newDirection);

        $newDirection = $this->direction->turnLeft();
        $this->assertEquals("N", $newDirection);
    }

    public function testCanTurnRight()
    {
        $newDirection = $this->direction->turnRight();
        $this->assertEquals("E", $newDirection);

        $newDirection = $this->direction->turnRight();
        $this->assertEquals("S", $newDirection);

        $newDirection = $this->direction->turnRight();
        $this->assertEquals("W", $newDirection);

        $newDirection = $this->direction->turnRight();
        $this->assertEquals("N", $newDirection);
    }
}
