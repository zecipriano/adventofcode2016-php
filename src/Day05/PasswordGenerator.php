<?php

namespace AdventOfCode2016\Day05;

class PasswordGenerator
{
    /**
     * Generate a password for the given $doorID.
     *
     * @param  string  $doorID       The door ID to generate a password for
     * @param  integer $passwordSize The size of the password to generate (default = 8)
     * @param  integer $zeroAmount   The number of zeros to validate each hash (default = 5)
     *
     * @return string                The generated password
     */
    public function generate(
        string $doorID,
        int $passwordSize = 8,
        int $zeroAmount = 5
    ) : string {
        $zeros = str_repeat("0", $zeroAmount);
        $password = "";
        $index = 0;

        while (strlen($password) < $passwordSize) {
            $hash = md5($doorID . $index);

            if (strcmp(substr($hash, 0, 5), $zeros) === 0) {
                $password .= $hash[5];
            }

            $index++;
        }

        return $password;
    }
}
