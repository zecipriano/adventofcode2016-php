<?php

namespace AdventOfCode2016\Day04;

class Decryptor
{
    const int N_LETTERS = 26;
    const int ASCII_LOWER_A = 97;
    const int ASCII_LOWER_Z = 122;

    /**
     * Decrypt the given $name with the given $id
     *
     * @param string $name The name to decrypt
     * @param int $id The id to decrypt the name with
     */
    public function decrypt(string $name, int $id): string
    {
        $arrayChars = str_split($name);
        $rotation = $id % self::N_LETTERS;

        foreach ($arrayChars as $index => $char) {
            if ($char === '-') {
                $arrayChars[$index] = " ";
                continue;
            }

            $newCharValue = ord($char) + $rotation;

            if ($newCharValue > self::ASCII_LOWER_Z) {
                $excess = $newCharValue - 1 - self::ASCII_LOWER_Z;
                $newCharValue = self::ASCII_LOWER_A + $excess;
            }

            $arrayChars[$index] = chr($newCharValue);
        }

        return implode($arrayChars);
    }
}
