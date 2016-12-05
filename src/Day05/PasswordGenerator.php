<?php

namespace AdventOfCode2016\Day05;

class PasswordGenerator
{
    const PASSWORD_SIZE = 8;
    const HASH_ZEROS = "00000";

    /**
     * Generate a password for the given $doorID.
     *
     * @param  string  $doorID       The door ID to generate a password for
     *
     * @return string                The generated password
     */
    public function generate(string $doorID) : string
    {
        $password = "";
        $index = 0;

        while (strlen($password) < self::PASSWORD_SIZE) {
            $hash = md5($doorID . $index);

            if (strcmp(substr($hash, 0, 5), self::HASH_ZEROS) === 0) {
                $password .= $hash[5];
            }

            $index++;
        }

        return $password;
    }

    /**
     * Generate an improved password for the given $doorID
     *
     * @param  string $doorID The door ID
     *
     * @return string         The improved password
     */
    public function generateImprovedPassword(string $doorID) : string
    {
        $password = [];
        $index = 0;

        while (count($password) < self::PASSWORD_SIZE) {
            $hash = md5($doorID . $index);

            if (strcmp(substr($hash, 0, 5), self::HASH_ZEROS) === 0) {
                $position = filter_var($hash[5], FILTER_VALIDATE_INT);

                if (is_int($position) &&
                    $position < self::PASSWORD_SIZE &&
                    !isset($password[$position])
                ) {
                    $password[$position] = $hash[6];
                }
            }

            $index++;
        }

        ksort($password);
        return implode($password);
    }
}
