<?php

namespace Tests\Day07;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day07\IPChecker;

class IPCheckerTest extends TestCase
{
    protected IPChecker $checker;

    protected function setUp(): void
    {
        $this->checker = new IPChecker();
    }

    /**
     * @dataProvider stringsTLS
     */
    public function testItChecksIfAnAddressSupportsTLS($string, $expected): void
    {
        $this->assertEquals($expected, $this->checker->checkTLS($string));
    }

    /**
     * @dataProvider stringsSSL
     */
    public function testItChecksIfAnAddressSupportsSSL($string, $expected): void
    {
        $this->assertEquals($expected, $this->checker->checkSSL($string));
    }

    public static function stringsTLS(): array
    {
        return [
            ['abba[mnop]qrst', true],
            ['abcd[bddb]xyyx', false],
            ['aaaa[qwer]tyui', false],
            ['ioxxoj[asdfgh]zxcvbn', true],
        ];
    }

    public static function stringsSSL(): array
    {
        return [
            ['aba[bab]xyz', true],
            ['xyx[xyx]xyx', false],
            ['aaa[kek]eke', true],
            ['zazbz[bzb]cdb', true],
        ];
    }
}
