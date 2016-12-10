<?php

namespace tests\Day10;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day10\InstructionParser;

class InstructionsParserTest extends TestCase
{
    /**
     * @dataProvider instructionsProvider
     */
    public function testItParsesIntructions(string $string, array $expected)
    {
        $parser = new InstructionParser();
        $parsed = $parser->parse($string);

        $this->assertEquals($expected, $parsed);
    }

    public function instructionsProvider()
    {
        return [
            [
                'value 5 goes to bot 2',
                ['type' => 'value', 'value' => 5, 'bot' => 2]
            ],
            [
                'bot 2 gives low to bot 1 and high to bot 0',
                [
                    'type' => 'gives',
                    'originBot' => 2,
                    'low' => ['bot', 1],
                    'high' => ['bot', 0]
                ]
            ],
            [
                'value 3 goes to bot 1',
                ['type' => 'value', 'value' => 3, 'bot' => 1]
            ],
            [
                'bot 1 gives low to output 1 and high to bot 0',
                [
                    'type' => 'gives',
                    'originBot' => 1,
                    'low' => ['output', 1],
                    'high' => ['bot', 0]
                ]
            ],
            [
                'bot 0 gives low to output 2 and high to output 0',
                [
                    'type' => 'gives',
                    'originBot' => 0,
                    'low' => ['output', 2],
                    'high' => ['output', 0]
                ]
            ],
            [
                'value 2 goes to bot 2',
                ['type' => 'value', 'value' => 2, 'bot' => 2]
            ],
        ];
    }
}
