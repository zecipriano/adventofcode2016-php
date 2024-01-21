<?php

namespace Tests\Day13;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day13\FloorLayout;

class FloorLayoutTest extends TestCase
{
    /**
     * @dataProvider coordinateProvider
     */
    public function testItCanCheckIfCoordinateIsOpenSpace(
        int $seed,
        array $coordinates,
        bool $expected
    ): void {
        $layout = new FloorLayout($seed);

        //$layout->showLayout([9,6]);

        $this->assertEquals($expected, $layout->isOpenSpace($coordinates));
    }

    /**
    * @dataProvider expandProvider
    */
    public function testItCanExpandCoordinates(
        int $seed,
        array $coordinate,
        array $expected
    ): void {
        $layout = new FloorLayout($seed);
        $this->assertEquals($expected, $layout->expand($coordinate));
    }

    /**
     * @dataProvider pathsProvider
     */
    public function testItCanFindTheShortestPath(
        int $seed,
        array $startCoordinate,
        array $endCoordinate,
        int $expected
    ): void {
        $layout = new FloorLayout($seed);
        $steps = $layout->shortestPath($startCoordinate, $endCoordinate);
        $this->assertEquals($expected, $steps);
    }

    public static function coordinateProvider(): array
    {
        $seed = 10;

        return [
            [$seed, [0, 0], true],
            [$seed, [7, 4], true],
            [$seed, [0, 1], true],
            [$seed, [9, 6], false],
            [$seed, [8, 6], false],
            [$seed, [2, 2], true],
        ];
    }

    public static function pathsProvider(): array
    {
        $seed = 10;
        $start = [1, 1];

        return [
            [$seed, $start, [1, 1], 0],
            [$seed, $start, [1, 2], 1],
            [$seed, $start, [2, 2], 2],
            [$seed, $start, [3, 2], 3],
            [$seed, $start, [3, 3], 4],
            [$seed, $start, [3, 4], 5],
            [$seed, $start, [4, 4], 6],
            [$seed, $start, [4, 5], 7],
            [$seed, $start, [5, 5], 8],
            [$seed, $start, [6, 5], 9],
            [$seed, $start, [6, 4], 10],
            [$seed, $start, [7, 4], 11],
        ];
    }

    public static function expandProvider(): array
    {
        $seed = 10;

        return [
            [
                $seed, [1, 1],
                [[1, 2], [0, 1]]
            ]
        ];
    }
}
