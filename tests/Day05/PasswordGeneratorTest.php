<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day05\PasswordGenerator;

class PasswordGeneratorTest extends TestCase
{
    public function testItGeneratesThePassword()
    {
        $generator = new PasswordGenerator();

        $password = $generator->generate('abc');
        $this->assertEquals('18f47a30', $password);
    }
}
