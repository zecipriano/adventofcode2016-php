<?php

namespace Tests\Day03;

use PHPUnit\Framework\TestCase;
use AdventOfCode2016\Day03\TriangleValidator;

class TriangleValidatorTest extends TestCase
{
    protected TriangleValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new TriangleValidator();
    }

    public function testFailedValidation(): void
    {
        $this->assertFalse($this->validator->validate(5, 10, 25));
    }

    public function testSuccessValidation(): void
    {
        $this->assertTrue($this->validator->validate(10, 10, 10));
    }
}
