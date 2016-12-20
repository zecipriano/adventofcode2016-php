<?php

namespace AdventOfCode2016\Day14;

class KeySearcher
{
    const OLD = 1000;

    public function searchKeys(string $salt, int $nKeys) : int
    {
        $validatedKeys = [];
        $waitingValidation = [];
        $index = 0;

        while (true) {
            // Hash
            $hash = md5($salt . $index);

            // Check if it is a possible validation key.
            $valChar = $this->isPossibleKeyValidation($hash);
            if ($valChar !== null &&
                isset($waitingValidation[$valChar]) &&
                count($waitingValidation[$valChar]) > 0) {
                foreach ($waitingValidation[$valChar] as $key) {
                    $validatedKeys[$key[1]] = $key[0];
                }

                $waitingValidation[$valChar] = [];
            }

            // Check if possible key
            $keyChar = $this->isPossibleKey($hash);
            if ($keyChar !== null) {
                $waitingValidation[$keyChar][] = [$index, $hash];
            }

            // Filter out old hashes
            foreach ($waitingValidation as &$value) {
                $value = array_filter($value, function ($key) use ($index) {
                    return $index - $key[0] < self::OLD;
                });
            }

            // Check if we reached the end and, if so, return.
            asort($validatedKeys);

            if (count($validatedKeys) > $nKeys &&
                $index > max(array_slice($validatedKeys, 0, $nKeys)) + self::OLD) {
                $array = array_slice($validatedKeys, $nKeys - 1, 1);
                return current($array);
            }

            $index++;
        }
    }

    /**
     * Check if is a possible key (3 repeating chars).
     *
     * @param  string      $hash The hash to check
     * @return string|null       The repeating char or null if not possible key.
     */
    public function isPossibleKey(string $hash) : ?string
    {
        $regex = '/(.)\1{2}/';

        if (preg_match($regex, $hash, $matches)) {
            return $matches[1];
        }

        return null;
    }

    /**
     * Check if possible key validation (5 repeating chars).
     * @param  string      $hash The hash to check.
     * @return string|null       The repeating char or null if not possible
     *                           validation.
     */
    public function isPossibleKeyValidation(string $hash) : ?string
    {
        $regex = '/(.)\1{4}/';

        if (preg_match($regex, $hash, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
