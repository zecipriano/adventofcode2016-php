<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day04\RoomStringParser;

class RoomStringParserTest extends TestCase
{
    protected $stringParser;

    protected function setUp(): void
    {
        $this->stringParser = new RoomStringParser();
    }

    public function testItParsesStrings()
    {
        $roomArray = $this->stringParser->parse("aaaaa-bbb-z-y-x-123[abxyz]");
        $expectedArray = ['name' => 'aaaaa-bbb-z-y-x', 'id' => 123, 'checksum' => 'abxyz'];
        $this->assertEquals($expectedArray, $roomArray);

        $roomArray = $this->stringParser->parse("a-b-c-d-e-f-g-h-987[abcde]");
        $expectedArray = ['name' => 'a-b-c-d-e-f-g-h', 'id' => 987, 'checksum' => 'abcde'];
        $this->assertEquals($expectedArray, $roomArray);

        $roomArray = $this->stringParser->parse("not-a-real-room-404[oarel]");
        $expectedArray = ['name' => 'not-a-real-room', 'id' => 404, 'checksum' => 'oarel'];
        $this->assertEquals($expectedArray, $roomArray);

        $roomArray = $this->stringParser->parse("totally-real-room-200[decoy]");
        $expectedArray = ['name' => 'totally-real-room', 'id' => 200, 'checksum' => 'decoy'];
        $this->assertEquals($expectedArray, $roomArray);
    }
}
