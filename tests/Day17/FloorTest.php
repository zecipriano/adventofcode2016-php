<?php

namespace tests\Day15;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day17\Floor;

class FloorTest extends TestCase
{
    protected $floor;

    public function setUp()
    {
        $this->floor = new Floor();
    }

    /**
     * @dataProvider doorsProvider
     */
    public function testItGetsOpenDoors(string $path, array $possibleDoors)
    {
        $this->assertEquals($possibleDoors, $this->floor->getOpenDoors($path));
    }

    public function doorsProvider()
    {
        return [
            ['hijkl',    ['U', 'D', 'L']],
            ['hijklD',   ['U', 'L', 'R']],
            ['hijklDR',  []],
            ['hijklDU',  ['R']],
            ['hijklDUR', []],
        ];
    }
}
