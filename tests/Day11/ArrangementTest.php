<?php

namespace tests\Day11;

use AdventOfCode2016\Day11\Arrangement;
use PHPUnit\Framework\TestCase;

class ArrangementTest extends TestCase
{
    protected $oc;

    /**
     * @dataProvider configurationsProvider
     */
    public function testIfConfigurationIsPossible(int $elevatorFloor, array $objects, bool $expected)
    {
        $arrangement = new Arrangement();
        $this->assertEquals($expected, $arrangement->set($elevatorFloor, $objects));
    }

    /**
     * @dataProvider nextArrangementsProvider
     */
    public function testItGeneratesNextConfigurations(
        int $elevatorFloor,
        array $objects,
        array $expected
    ) {
        $arrangement = new Arrangement();
        $arrangement->set($elevatorFloor, $objects);

        $next = $arrangement->nextPossibleArrangements();
        $this->assertEquals($expected, $next);
    }

    public function testItComparesArrangements()
    {
        $arr1 = new Arrangement(0, [1, 0, 2, 0]);
        $arr2 = new Arrangement(0, [1, 0, 2, 0]);

        $this->assertTrue($arr1->isEqual($arr2));

        $arr1 = new Arrangement(0, [1, 0, 2, 0]);
        $arr2 = new Arrangement(0, [1, 0, 2, 3]);

        $this->assertFalse($arr1->isEqual($arr2));
    }

    public function configurationsProvider()
    {
        return [
            [0, [1, 0, 2, 0], true],
            [0, [1, 1, 2, 0], true],
            [0, [1, 2, 2, 0], false],
        ];
    }

    public function nextArrangementsProvider()
    {
        return [
            [
                0, [1, 0, 2, 0],
                [new Arrangement(1, [1, 1, 2, 0])]
            ],
            [
                3, [3, 3, 3, 3],
                []
            ],
            [
                2, [2, 2, 2, 2],
                [
                    new Arrangement(3, [2, 3, 2 ,2]),
                    new Arrangement(3, [2, 2, 2, 3]),
                    new Arrangement(3, [3, 3, 2, 2]),
                    new Arrangement(3, [3, 2, 3, 2]),
                    new Arrangement(3, [2, 3, 2, 3]),
                    new Arrangement(3, [2, 2, 3, 3]),
                ]
            ],
            [
                2, [2, 2, 2, 2, 2, 2, 2, 2, 2, 2],
                [
                    new Arrangement(3, [2, 3, 2, 2, 2, 2, 2, 2, 2, 2]),
                    new Arrangement(3, [2, 2, 2, 3, 2, 2, 2, 2, 2, 2]),
                    new Arrangement(3, [2, 2, 2, 2, 2, 3, 2, 2, 2, 2]),
                    new Arrangement(3, [2, 2, 2, 2, 2, 2, 2, 3, 2, 2]),
                    new Arrangement(3, [2, 2, 2, 2, 2, 2, 2, 2, 2, 3]),
                    new Arrangement(3, [3, 3, 2, 2, 2, 2, 2, 2, 2, 2]),
                    new Arrangement(3, [2, 3, 2, 3, 2, 2, 2, 2, 2, 2]),
                    new Arrangement(3, [2, 3, 2, 2, 2, 3, 2, 2, 2, 2]),
                    new Arrangement(3, [2, 3, 2, 2, 2, 2, 2, 3, 2, 2]),
                    new Arrangement(3, [2, 3, 2, 2, 2, 2, 2, 2, 2, 3]),
                    new Arrangement(3, [2, 2, 3, 3, 2, 2, 2, 2, 2, 2]),
                    new Arrangement(3, [2, 2, 2, 3, 2, 3, 2, 2, 2, 2]),
                    new Arrangement(3, [2, 2, 2, 3, 2, 2, 2, 3, 2, 2]),
                    new Arrangement(3, [2, 2, 2, 3, 2, 2, 2, 2, 2, 3]),
                    new Arrangement(3, [2, 2, 2, 2, 3, 3, 2, 2, 2, 2]),
                    new Arrangement(3, [2, 2, 2, 2, 2, 3, 2, 3, 2, 2]),
                    new Arrangement(3, [2, 2, 2, 2, 2, 3, 2, 2, 2, 3]),
                    new Arrangement(3, [2, 2, 2, 2, 2, 2, 3, 3, 2, 2]),
                    new Arrangement(3, [2, 2, 2, 2, 2, 2, 2, 3, 2, 3]),
                    new Arrangement(3, [2, 2, 2, 2, 2, 2, 2, 2, 3, 3]),
                ]
            ],
            [
                0, [0, 0, 1, 2, 1, 2, 1, 2, 1, 2],
                [
                    new Arrangement(1, [1, 1, 1, 2, 1, 2, 1, 2, 1, 2])
                ]
            ]
        ];
    }
}
