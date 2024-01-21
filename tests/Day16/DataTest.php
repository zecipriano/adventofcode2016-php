<?php

namespace Tests\Day16;

use AdventOfCode2016\Day16\Data;
use PHPUnit\Framework\TestCase;

class DataTest extends TestCase
{
    protected Data $data;

    public function setUp(): void
    {
        $this->data = new Data();
    }

    /**
     * @dataProvider dataProvider
     */
    public function testItDoublesData(string $inString, string $outString): void
    {
        $this->assertEquals($outString, $this->data->doubleData($inString));
    }

    public function testItFillsDisk(): void
    {
        $expected = '10000011110010000111';
        $this->assertEquals($expected, $this->data->fillDisk('10000', 20));
    }

    public function testItCalculatesChecksum(): void
    {
        $expected = '100';
        $this->assertEquals($expected, $this->data->calcCheckSum('110010110100'));
    }

    public function testItGetsChecksumFromInitialString(): void
    {
        $this->assertEquals('01100', $this->data->checkSum('10000', 20));
    }

    public static function dataProvider(): array
    {
        return [
            ['1', '100'],
            ['0', '001'],
            ['11111', '11111000000'],
            ['111100001010', '1111000010100101011110000'],
        ];
    }
}
