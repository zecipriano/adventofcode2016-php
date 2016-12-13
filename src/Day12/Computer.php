<?php

namespace AdventOfCode2016\Day12;

class Computer
{
    protected $registers;

    public function __construct()
    {
        $this->registers = [
            'a' => 0,
            'b' => 0,
            'c' => 0,
            'd' => 0,
        ];
    }

    /**
     * Copy $value to the designated $register. $value can be an integer or
     * another register.
     *
     * @param int|string $value    The value (an int or another register) to
     *                             copy to the $register.
     * @param string     $register The destination register.
     */
    public function cpy($value, string $register) : void
    {
        if (isset($this->registers[$value])) {
            $this->registers[$register] = $this->registers[$value];
        }

        if (filter_var($value, FILTER_VALIDATE_INT)) {
            $this->registers[$register] = $value;
        }
    }

    /**
     * Increment the value of the given $register.
     *
     * @param string $register The register to increment.
     */
    public function inc(string $register) : void
    {
        $this->registers[$register]++;
    }

    /**
     * Decrement the value of the given $register.
     *
     * @param string $register The register to decrement.
     */
    public function dec(string $register) : void
    {
        $this->registers[$register]--;
    }

    /**
     * Returns the value of the given register.
     *
     * @param  string $register The register to get the value from.
     * @return int              The value of the register.
     */
    public function getRegisterValue(string $register) : int
    {
        return $this->registers[$register];
    }

    /**
     * Execute the given $instructionSet.
     *
     * @param array $instructionSet An array of instructions.
     */
    public function execute(array $instructionSet) : void
    {
        $nInstructions = count($instructionSet);
        $currentInstruction = 0;
        $iteration = 0;

        $instructions = $this->parseInstructions($instructionSet);

        while ($currentInstruction < $nInstructions) {
            $instruction = $instructions[$currentInstruction];

            switch ($instruction[0]) {
                case 'cpy':
                    $this->cpy($instruction[1], $instruction[2]);
                    $currentInstruction++;
                    break;
                case 'inc':
                    $this->inc($instruction[1]);
                    $currentInstruction++;
                    break;
                case 'dec':
                    $this->dec($instruction[1]);
                    $currentInstruction++;
                    break;
                case 'jnz':
                    $isPositiveInt = filter_var($instruction[1], FILTER_VALIDATE_INT) &&
                                     intval($instruction[1]) !== 0;
                    $isPositiveRegister = isset($this->registers[$instruction[1]]) &&
                                          $this->getRegisterValue($instruction[1]) !== 0;

                    if ($isPositiveInt || $isPositiveRegister) {
                        $currentInstruction += (int)$instruction[2];
                    } else {
                        $currentInstruction++;
                    }
                    break;
            }
        }
    }

    /**
     * Transforms an array of strings in an array of arrays.
     *
     * @param  array $instructionSet An array of strings.
     * @return array                 An array of arrays.
     */
    protected function parseInstructions(array $instructionSet) : array
    {
        $instructions = [];

        foreach ($instructionSet as $index => $instruction) {
            $instructions[$index] = explode(" ", $instruction);
        }

        ksort($instructions);
        return $instructions;
    }
}
