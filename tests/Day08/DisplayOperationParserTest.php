<?php

namespace Tests\Day08;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day08\DisplayOperationParser;

class DisplayOperationParserTest extends TestCase
{
    /**
     * @dataProvider commandsProvider
     */
    public function testItParsesTheOperation(string $string, array $expected)
    {
        $parser = new DisplayOperationParser;
        $this->assertEquals($expected, $parser->parse($string));
    }

    public function commandsProvider()
    {
        return [
            ['rect 3x2', ['rect', 3, 2]],
            ['rotate column x=1 by 1', ['rotate column', 1, 1]],
            ['rotate row y=0 by 4', ['rotate row', 0, 4]],
        ];
    }
}
