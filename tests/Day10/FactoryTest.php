<?php

namespace tests\Day10;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day10\Factory;

class FactoryTest extends TestCase
{
    public function testFactoryDispatchesInstructions()
    {
        $factory = new Factory();
        $factory->dispatchInstruction('value 5 goes to bot 2');
        $this->assertEquals("bot 2 [5]", $factory->getBot(2)->describe());

        $factory->dispatchInstruction('bot 2 gives low to bot 1 and high to bot 0');
        $this->assertEquals("bot 2 [5]", $factory->getBot(2)->describe());
        $this->assertEquals("bot 1 []", $factory->getBot(2)->getLowReceiver()->describe());
        $this->assertEquals("bot 0 []", $factory->getBot(2)->getHighReceiver()->describe());

        $factory->dispatchInstruction('value 3 goes to bot 1');
        $this->assertEquals("bot 2 [5]", $factory->getBot(2)->describe());
        $this->assertEquals("bot 1 [3]", $factory->getBot(2)->getLowReceiver()->describe());
        $this->assertEquals("bot 0 []", $factory->getBot(2)->getHighReceiver()->describe());
        $this->assertEquals("bot 1 [3]", $factory->getBot(1)->describe());

        $factory->dispatchInstruction('bot 1 gives low to output 1 and high to bot 0');
        $this->assertEquals("bot 2 [5]", $factory->getBot(2)->describe());
        $this->assertEquals("bot 1 [3]", $factory->getBot(2)->getLowReceiver()->describe());
        $this->assertEquals("bot 0 []", $factory->getBot(2)->getHighReceiver()->describe());
        $this->assertEquals("bot 1 [3]", $factory->getBot(1)->describe());
        $this->assertEquals("output 1 []", $factory->getBot(1)->getLowReceiver()->describe());
        $this->assertEquals("bot 0 []", $factory->getBot(1)->getHighReceiver()->describe());

        $factory->dispatchInstruction('bot 0 gives low to output 2 and high to output 0');
        $this->assertEquals("bot 2 [5]", $factory->getBot(2)->describe());
        $this->assertEquals("bot 1 [3]", $factory->getBot(2)->getLowReceiver()->describe());
        $this->assertEquals("bot 0 []", $factory->getBot(2)->getHighReceiver()->describe());
        $this->assertEquals("bot 1 [3]", $factory->getBot(1)->describe());
        $this->assertEquals("output 1 []", $factory->getBot(1)->getLowReceiver()->describe());
        $this->assertEquals("bot 0 []", $factory->getBot(1)->getHighReceiver()->describe());
        $this->assertEquals("output 2 []", $factory->getBot(0)->getLowReceiver()->describe());
        $this->assertEquals("output 0 []", $factory->getBot(0)->getHighReceiver()->describe());

        $factory->dispatchInstruction('value 2 goes to bot 2');
        $this->assertEquals("bot 0 []", $factory->getBot(0)->describe());
        $this->assertEquals("bot 1 []", $factory->getBot(1)->describe());
        $this->assertEquals("bot 2 []", $factory->getBot(2)->describe());
        $this->assertEquals("output 0 [5]", $factory->getOutput(0)->describe());
        $this->assertEquals("output 1 [2]", $factory->getOutput(1)->describe());
        $this->assertEquals("output 2 [3]", $factory->getOutput(2)->describe());
    }
}
