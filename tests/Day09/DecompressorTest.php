<?php

namespace Tests\Day09;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day09\Decompressor;

class DecompressorTest extends TestCase
{
    protected Decompressor $decompressor;

    public function setUp(): void
    {
        $this->decompressor = new Decompressor();
    }

    /**
     * @dataProvider stringsLengthProvider
     */
    public function testItGetsTheLengthOfTheDecompressedString(string $string, int $expected): void
    {
        $this->assertEquals($expected, $this->decompressor->decompressedLength($string));
    }

    /**
     * @dataProvider recursiveStringLength
     */
    public function testItGetsTheLengthOfTheRecursivelyDecompressedString(string $string, int $expected): void
    {
        $this->assertEquals($expected, $this->decompressor->decompressedLength($string, true));
    }

    public static function stringsLengthProvider(): array
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

    public static function recursiveStringLength(): array
    {
        return [
            ['(3x3)XYZ', 9],
            ['X(8x2)(3x3)ABCY', 20],
            ['(27x12)(20x12)(13x14)(7x10)(1x12)A', 241920],
            ['(25x3)(3x3)ABC(2x3)XY(5x2)PQRSTX(18x9)(3x2)TWO(5x7)SEVEN', 445],
        ];
    }
}
