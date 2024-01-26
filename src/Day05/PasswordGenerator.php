<?php

namespace AdventOfCode2016\Day05;

class PasswordGenerator
{
    protected const int PASSWORD_SIZE = 8;
    protected const int HASH_ZEROS = 5;
    protected const string STRING_ZEROS = "00000";

    /**
     * Generate a password and a improved password for the given $doorID.
     *
     * @param string $doorID The door ID to generate a password for
     *
     * @return array          The generated passwords
     */
    public function generate(string $doorID): array
    {
        $password = "";
        $improvedPassword = [];
        $index = 0;
        $passNotDone = strlen($password) < self::PASSWORD_SIZE;
        $impPassNotDone = true;

        while ($passNotDone || $impPassNotDone) {
            $hash = md5($doorID . $index);

            $hashIsValid = $this->checkHash($hash);

            if ($hashIsValid && $passNotDone) {
                $password .= $hash[5];
                $passNotDone = strlen($password) < self::PASSWORD_SIZE;
            }

            if ($hashIsValid && $impPassNotDone) {
                $this->checkPositionAndFill($improvedPassword, $hash);
                $impPassNotDone = count($improvedPassword) < self::PASSWORD_SIZE;
            }

            $index++;
        }

        ksort($improvedPassword);

        return [
            'password' => $password,
            'improvedPassword' => implode($improvedPassword),
        ];
    }

    /**
     * Determines the position to fill and, if its valid, fills it.
     *
     * @param array $password The array with the password chars.
     * @param string $hash The hash to determine the position.
     */
    protected function checkPositionAndFill(
        array &$password,
        string $hash
    ): void {
        $position = filter_var($hash[5], FILTER_VALIDATE_INT);

        $isInt = is_int($position);
        $positionIsPossible = $position < self::PASSWORD_SIZE;
        $isNotFilledYet = ! isset($password[$position]);

        if ($isInt && $positionIsPossible && $isNotFilledYet) {
            $password[$position] = $hash[6];
        }
    }

    /**
     * Check if the given $hash starts with the defined amount of zeros.
     *
     * @param string $hash The hash to check.
     *
     * @return bool Whether the hash starts with the defined amount of zeros.
     */
    protected function checkHash(string $hash): bool
    {
        $hashSignificantChars = substr($hash, 0, self::HASH_ZEROS);

        return strcmp($hashSignificantChars, self::STRING_ZEROS) === 0;
    }
}
