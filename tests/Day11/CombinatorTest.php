<?php

namespace Tests\Day11;

use AdventOfCode2016\Day11\Combinator;
use PHPUnit\Framework\TestCase;

class CombinatorTest extends TestCase
{
    public function testInstantiation(): void
    {
        $c = new Combinator([1, 2, 3, 4, 5]);

        $this->assertInstanceOf(Combinator::class, $c);
    }

    public function testCountCombinationsOf5x3(): void
    {
        $c = new Combinator([1, 2, 3, 4, 5], 3);

        $items = [];
        foreach ($c as $item) {
            $items[] = $item;
        }

        $this->assertCount(10, $items);
        $this->assertCount(3, $items[0]);
    }

    public function testCountCombinationsOf5x5(): void
    {
        $c = new Combinator([1, 2, 3, 4, 5], 5);

        $items = [];
        foreach ($c as $item) {
            $items[] = $item;
        }

        $this->assertCount(1, $items);
        $this->assertCount(5, $items[0]);
    }
}
