<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day05\PasswordGenerator;

class PasswordGeneratorTest extends TestCase
{
    protected $generator;

    protected function setUp()
    {
        $this->generator = new PasswordGenerator();
    }

    public function testItGeneratesThePassword()
    {
        $password = $this->generator->generate('abc');
        $this->assertEquals('18f47a30', $password);
    }

    public function testItGeneratesTheBetterPassword()
    {
        $password = $this->generator->generateImprovedPassword('abc');
        $this->assertEquals('05ace8e3', $password);
    }
}
