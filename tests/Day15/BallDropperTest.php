<?php

namespace tests\Day15;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day15\DiscSet;
use AdventOfCode2016\Day15\BallDropper;


class BallDropperTest extends TestCase
{
    protected $ballDropper;

    public function setUp()
    {
        $discConfig = [
            1 => ['nPositions' => 5, 'position' => 4],
            2 => ['nPositions' => 2, 'position' => 1],
        ];

        $discSet = new DiscSet($discConfig);
        $this->ballDropper = new BallDropper($discSet);
    }

    public function testFirstBallToPass()
    {
        $firstBall = $this->ballDropper->dropBalls();
        $this->assertEquals(5, $firstBall);
    }
}
