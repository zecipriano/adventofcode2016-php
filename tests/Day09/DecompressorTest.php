<?php

namespace tests\Day09;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day09\Decompressor;

class DecompressorTest extends TestCase
{
    protected $decompressor;

    public function setUp()
    {
        $this->decompressor = new Decompressor();
    }

    /**
     * @dataProvider stringsProvider
     */
    public function testItDecompressesStrings(string $string, string $expected)
    {
        $this->assertEquals($expected, $this->decompressor->decompress($string));
    }

    /**
     * @dataProvider stringsLengthProvider
     */
    public function testItGetsTheLengthOfTheDecompressedString(string $string, int $expected)
    {
        $this->assertEquals($expected, $this->decompressor->decompressedLength($string));
    }

    public function stringsProvider()
    {
        return [
            ['ADVENT', 'ADVENT'],
            ['A(1x5)BC', 'ABBBBBC'],
            ['(3x3)XYZ', 'XYZXYZXYZ'],
            ['A(2x2)BCD(2x2)EFG', 'ABCBCDEFEFG'],
            ['(6x1)(1x3)A', '(1x3)A'],
            ['X(8x2)(3x3)ABCY', 'X(3x3)ABC(3x3)ABCY'],
        ];
    }

    public function stringsLengthProvider()
    {
        return [
            ['ADVENT', 6],
            ['A(1x5)BC', 7],
            ['(3x3)XYZ', 9],
            ['A(2x2)BCD(2x2)EFG', 11],
            ['(6x1)(1x3)A', 6],
            ['X(8x2)(3x3)ABCY', 18],
        ];
    }
}
