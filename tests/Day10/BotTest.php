<?php

namespace Tests\Day10;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day10\Bot;
use AdventOfCode2016\Day10\Output;

class BotTest extends TestCase
{
    public function testBots(): void
    {
        $bot0 = new Bot();
        $bot1 = new Bot();
        $bot2 = new Bot();
        $output0 = new Output();
        $output1 = new Output();
        $output2 = new Output();

        $bot2->receivesValue(5);
        $bot2->setReceivers($bot1, $bot0);

        $bot1->receivesValue(3);
        $bot1->setReceivers($output1, $bot0);

        $bot0->setReceivers($output2, $output0);

        $bot2->receivesValue(2);

        $this->assertEquals([5], $output0->getReceivedValues());
        $this->assertEquals([2], $output1->getReceivedValues());
        $this->assertEquals([3], $output2->getReceivedValues());
    }
}
