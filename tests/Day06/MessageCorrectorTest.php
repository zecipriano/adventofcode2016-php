<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day06\MessageCorrector;

class MessageCorrectorTest extends TestCase
{
    public function testItCorrectsTheMessage()
    {
        $messagesArray = [
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

        $messageCorrector = new MessageCorrector();
        $correctedMessage = $messageCorrector->correct($messagesArray);

        $this->assertEquals('easter', $correctedMessage);
    }
}
