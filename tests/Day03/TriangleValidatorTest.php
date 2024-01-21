<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day03\TriangleValidator;

class TriangleValidatorTest extends TestCase
{
    protected $validator;

    protected function setUp(): void
    {
        $this->validator = new TriangleValidator();
    }

    public function testFailedValidation()
    {
        $this->assertFalse($this->validator->validate(5, 10, 25));
    }

    public function testSuccessValidation()
    {
        $this->assertTrue($this->validator->validate(10, 10, 10));
    }
}
