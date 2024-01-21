<?php

namespace Tests\Day11;

use AdventOfCode2016\Day11\ArrangementManager;
use PHPUnit\Framework\TestCase;

class ArrangementTest extends TestCase
{
    protected $oc;

    /**
     * @dataProvider configurationsProvider
     */
    public function testIfConfigurationIsPossible(array $arrangement, bool $expected)
    {
        $arrangementManager = new ArrangementManager();
        $this->assertEquals($expected, $arrangementManager->isPossible($arrangement['objects']));
    }

    /**
     * @dataProvider nextArrangementsProvider
     */
    public function testItGeneratesNextConfigurations(
        array $arrangement,
        array $expected
    ) {

        $arrangementManager = new ArrangementManager();
        $next = $arrangementManager->nextPossibleArrangements($arrangement);
        $this->assertEquals($expected, $next);
    }

    public static function configurationsProvider()
    {
        return [
            [['elevator' => 0, 'objects' => [1, 0, 2, 0]], true],
            [['elevator' => 0, 'objects' => [1, 1, 2, 0]], true],
            [['elevator' => 0, 'objects' => [1, 2, 2, 0]], false],
        ];
    }

    public static function nextArrangementsProvider()
    {
        return [
            [
                ['elevator' => 0, 'objects' => [1, 0, 2, 0]],
                [
                    ['elevator' => 1, 'objects' => [1, 1, 2, 0]]
                ]
            ],
            [
                ['elevator' => 3, 'objects' => [3, 3, 3, 3]],
                []
            ],
            [
                ['elevator' => 2, 'objects' => [2, 2, 2, 2]],
                [
                    ['elevator' => 3, 'objects' => [2, 3, 2 ,2]],
                    ['elevator' => 3, 'objects' => [2, 2, 2, 3]],
                    ['elevator' => 3, 'objects' => [3, 3, 2, 2]],
                    ['elevator' => 3, 'objects' => [3, 2, 3, 2]],
                    ['elevator' => 3, 'objects' => [2, 3, 2, 3]],
                    ['elevator' => 3, 'objects' => [2, 2, 3, 3]],
                ]
            ],
            [
                ['elevator' => 2, 'objects' => [2, 2, 2, 2, 2, 2, 2, 2, 2, 2]],
                [
                    ['elevator' => 3, 'objects' => [2, 3, 2, 2, 2, 2, 2, 2, 2, 2]],
                    ['elevator' => 3, 'objects' => [2, 2, 2, 3, 2, 2, 2, 2, 2, 2]],
                    ['elevator' => 3, 'objects' => [2, 2, 2, 2, 2, 3, 2, 2, 2, 2]],
                    ['elevator' => 3, 'objects' => [2, 2, 2, 2, 2, 2, 2, 3, 2, 2]],
                    ['elevator' => 3, 'objects' => [2, 2, 2, 2, 2, 2, 2, 2, 2, 3]],
                    ['elevator' => 3, 'objects' => [3, 3, 2, 2, 2, 2, 2, 2, 2, 2]],
                    ['elevator' => 3, 'objects' => [2, 3, 2, 3, 2, 2, 2, 2, 2, 2]],
                    ['elevator' => 3, 'objects' => [2, 3, 2, 2, 2, 3, 2, 2, 2, 2]],
                    ['elevator' => 3, 'objects' => [2, 3, 2, 2, 2, 2, 2, 3, 2, 2]],
                    ['elevator' => 3, 'objects' => [2, 3, 2, 2, 2, 2, 2, 2, 2, 3]],
                    ['elevator' => 3, 'objects' => [2, 2, 3, 3, 2, 2, 2, 2, 2, 2]],
                    ['elevator' => 3, 'objects' => [2, 2, 2, 3, 2, 3, 2, 2, 2, 2]],
                    ['elevator' => 3, 'objects' => [2, 2, 2, 3, 2, 2, 2, 3, 2, 2]],
                    ['elevator' => 3, 'objects' => [2, 2, 2, 3, 2, 2, 2, 2, 2, 3]],
                    ['elevator' => 3, 'objects' => [2, 2, 2, 2, 3, 3, 2, 2, 2, 2]],
                    ['elevator' => 3, 'objects' => [2, 2, 2, 2, 2, 3, 2, 3, 2, 2]],
                    ['elevator' => 3, 'objects' => [2, 2, 2, 2, 2, 3, 2, 2, 2, 3]],
                    ['elevator' => 3, 'objects' => [2, 2, 2, 2, 2, 2, 3, 3, 2, 2]],
                    ['elevator' => 3, 'objects' => [2, 2, 2, 2, 2, 2, 2, 3, 2, 3]],
                    ['elevator' => 3, 'objects' => [2, 2, 2, 2, 2, 2, 2, 2, 3, 3]],
                ]
            ],
            [
                ['elevator' => 0, 'objects' => [0, 0, 1, 2, 1, 2, 1, 2, 1, 2]],
                [
                    ['elevator' => 1, 'objects' => [1, 1, 1, 2, 1, 2, 1, 2, 1, 2]]
                ]
            ]
        ];
    }
}
