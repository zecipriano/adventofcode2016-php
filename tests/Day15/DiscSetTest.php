<?php

namespace Tests\Day15;

use AdventOfCode2016\Day15\DiscSet;
use PHPUnit\Framework\TestCase;

class DiscSetTest extends TestCase
{
    protected DiscSet $discSet;

    public function setUp(): void
    {
        $config = [
            1 => ['nPositions' => 5, 'position' => 4],
            2 => ['nPositions' => 2, 'position' => 1],
        ];

        $this->discSet = new DiscSet($config);
    }

    public function testItSetsTheInitialPositions(): void
    {
        $this->assertEquals(4, $this->discSet->getDiscPosition(1));
        $this->assertEquals(1, $this->discSet->getDiscPosition(2));
        $this->assertEquals(-1, $this->discSet->getDiscPosition(3));
    }

    public function testsItMovesTheDiscs(): void
    {
        $this->discSet->tick();
        $this->assertEquals(0, $this->discSet->getDiscPosition(1));
        $this->assertEquals(0, $this->discSet->getDiscPosition(2));
    }

    public function testTheDiscAlign(): void
    {
        $this->discSet->tick(); // t1
        $this->discSet->tick(); // t2
        $this->discSet->tick(); // t3
        $this->discSet->tick(); // t4
        $this->discSet->tick(); // t5 -> push button
        $this->discSet->tick(); // t6 -> ball reaches first disc
        $this->assertEquals(0, $this->discSet->getDiscPosition(1));
        $this->discSet->tick(); // t7 -> ball reaches second disc
        $this->assertEquals(0, $this->discSet->getDiscPosition(2));
    }

    public function testFirstBallToPass(): void
    {
        $config = [
            1 => ['nPositions' => 5, 'position' => 4],
            2 => ['nPositions' => 2, 'position' => 1],
        ];

        $discSet = new DiscSet($config);
        $dropTime = $discSet->findDropTime();
        $this->assertEquals(5, $dropTime);
    }
}
