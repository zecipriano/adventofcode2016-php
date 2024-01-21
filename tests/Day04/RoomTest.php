<?php

namespace Tests\Day04;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day04\Room;

class RoomTest extends TestCase
{
    protected Room $room;

    protected function setUp(): void
    {
        $this->room = new Room();
    }

    public function testItCalculatesChecksum(): void
    {
        $checksum = $this->room->calcChecksum('aaaaa-bbb-z-y-x');
        $this->assertEquals('abxyz', $checksum);

        $checksum = $this->room->calcChecksum('a-b-c-d-e-f-g-h');
        $this->assertEquals('abcde', $checksum);

        $checksum = $this->room->calcChecksum('not-a-real-room');
        $this->assertEquals('oarel', $checksum);
    }

    public function testItValidatesChecksum(): void
    {
        $this->assertTrue($this->room->valChecksum('aaaaa-bbb-z-y-x', 'abxyz'));
        $this->assertTrue($this->room->valChecksum('a-b-c-d-e-f-g-h', 'abcde'));
        $this->assertTrue($this->room->valChecksum('not-a-real-room', 'oarel'));
        $this->assertFalse($this->room->valChecksum('totally-real-room', 'decoy'));
    }
}
