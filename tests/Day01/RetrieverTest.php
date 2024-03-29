<?php

namespace Tests\Day01;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day01\Retriever;

class RetrieverTest extends TestCase
{
    protected Retriever $retriever;

    protected function setUp(): void
    {
        $this->retriever = new Retriever();
    }

    public function testMove1(): void
    {
        $this->retriever->move("R", 2);
        $this->retriever->move("L", 3);

        $distance = $this->retriever->getDistance();

        $this->assertEquals(5, $distance);
    }

    public function testMove2(): void
    {
        $this->retriever->move("R", 2);
        $this->retriever->move("R", 2);
        $this->retriever->move("R", 2);

        $distance = $this->retriever->getDistance();

        $this->assertEquals(2, $distance);
    }

    public function testMove3(): void
    {
        $this->retriever->move("R", 5);
        $this->retriever->move("L", 5);
        $this->retriever->move("R", 5);
        $this->retriever->move("R", 3);

        $distance = $this->retriever->getDistance();

        $this->assertEquals(12, $distance);
    }

    public function testFirstRepeatedPosition(): void
    {
        $this->retriever->move("R", 8);
        $this->retriever->move("R", 4);
        $this->retriever->move("R", 4);
        $this->retriever->move("R", 8);

        $firstRepeatedDistance = $this->retriever->getFirstRepeatedDistance();
        $this->assertEquals(4, $firstRepeatedDistance);
    }
}
