<?php

namespace tests\Day12;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day12\Computer;

class ComputerTest extends TestCase
{
    public function testItExecuteInstructions()
    {
        $computer = new Computer();

        $computer->cpy(41, 'a');
        $this->assertEquals(41, $computer->getRegisterValue('a'));

        $computer->inc('a');
        $this->assertEquals(42, $computer->getRegisterValue('a'));

        $computer->inc('a');
        $this->assertEquals(43, $computer->getRegisterValue('a'));

        $computer->dec('a');
        $this->assertEquals(42, $computer->getRegisterValue('a'));
    }

    public function testItExecuteInstructionSet()
    {
        $computer = new Computer();
        $instructionSet = [
            'cpy 41 a',
            'inc a',
            'inc a',
            'dec a',
            'jnz a 2',
            'dec a',
        ];

        $computer->execute($instructionSet);
        $this->assertEquals(42, $computer->getRegisterValue('a'));
    }
}
