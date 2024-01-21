<?php

namespace Tests\Day06;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day06\MessageCorrector;

class MessageCorrectorTest extends TestCase
{
    protected $corrector;
    protected $messagesArray;

    protected function setUp(): void
    {
        $this->corrector = new MessageCorrector();
        $this->messagesArray = [
            'eedadn',
            'drvtee',
            'eandsr',
            'raavrd',
            'atevrs',
            'tsrnev',
            'sdttsa',
            'rasrtv',
            'nssdts',
            'ntnada',
            'svetve',
            'tesnvt',
            'vntsnd',
            'vrdear',
            'dvrsen',
            'enarar'
        ];
    }

    public function testItCorrectsTheMessage()
    {
        $correctedMessage = $this->corrector->correctMC($this->messagesArray);
        $this->assertEquals('easter', $correctedMessage);
    }

    public function testItCorrectsTheMessageLeastCommon()
    {
        $correctedMessage = $this->corrector->correctLC($this->messagesArray);
        $this->assertEquals('advent', $correctedMessage);
    }
}
