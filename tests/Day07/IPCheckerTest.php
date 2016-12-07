<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day07\IPChecker;

class IPCheckerTest extends TestCase
{
    /**
     * @dataProvider stringsProvider
     */
    public function testItChecksIfAnAddressSupportsTLS($string, $expected)
    {
        $checker = new IPChecker();
        $this->assertEquals($expected, $checker->checkTLS($string));
    }

    public function stringsProvider()
    {
        return [
            ['abba[mnop]qrst', true],
            ['abcd[bddb]xyyx', false],
            ['aaaa[qwer]tyui', false],
            ['ioxxoj[asdfgh]zxcvbn', true]
        ];
    }
}
