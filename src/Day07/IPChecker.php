<?php

namespace AdventOfCode2016\Day07;

class IPChecker
{
    /**
     * Check if a IP address supports TLS. It supports TLS if it contains an
     * 'abba' pattern outside brackets. If a 'abba' pattern is present inside
     * brackets, the IP address doesn't support TLS.
     *
     * @param  string $IPAddress The IP address (ficticious IPv7 format)
     *
     * @return bool              Whether the address supports TLS
     */
    public function checkTLS(string $IPAddress) : bool
    {
        $matches = [];

        // All 'abba' patterns (it ignores 'aaaa' patterns).
        $regex = '/([a-z])(?!\1)([a-z])\2\1/';
        preg_match_all($regex, $IPAddress, $matches);
        $countAll = count($matches[0]);

        // Only 'abba' patterns inside brackets (it ignores 'aaaa' patterns)
        // Exact matches are in group 1.
        $regex = '/\[[a-z]*(([a-z])(?!\2)([a-z])\3\2)[a-z]*\]/';
        preg_match_all($regex, $IPAddress, $matches);
        $countInsideBrackets = count($matches[1]);

        if ($countAll && !$countInsideBrackets) {
            return true;
        }

        return false;
    }

    /**
     * Check if a IP address supports SSL. It supports TLS if it contains an
     * 'aba' pattern outside brackets and the inverse 'bab' inside brackets.
     * Patterns can overlap.
     *
     * @param  string $IPAddress The IP address (ficticious IPv7 format)
     *
     * @return bool              Whether the address supports TLS
     */
    public function checkSSL(string $IPAddress) : bool
    {
        // Only 'aba' patterns outside brackets. Patterns can overlap.
        $regex = '/(?=([a-z])(?!\1)([a-z])\1)(?![a-z]*\])/';
        $count = preg_match_all($regex, $IPAddress, $matches);

        if (!$count) {
            return false;
        }

        $countInsideBrackets = 0;

        foreach ($matches[1] as $index => $char) {
            $inverse = $matches[2][$index] . $char . $matches[2][$index];
            $regex = '/\[[a-z]*(' . $inverse . ')[a-z]*\]/';
            $countInsideBrackets += preg_match($regex, $IPAddress);
        }

        return boolval($countInsideBrackets);
    }
}
