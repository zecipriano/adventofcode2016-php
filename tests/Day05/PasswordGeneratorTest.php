<?php

namespace Tests\Day05;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day05\PasswordGenerator;

class PasswordGeneratorTest extends TestCase
{
    protected $generator;

    protected function setUp(): void
    {
        $this->generator = new PasswordGenerator();
    }

    public function testItGeneratesThePassword()
    {
        $passwords = $this->generator->generate('abc');
        $this->assertEquals('18f47a30', $passwords['password']);
        $this->assertEquals('05ace8e3', $passwords['improvedPassword']);
    }
}
