<?php

namespace AdventOfCode2016\Day06;

class MessageCorrector
{
    /**
     * Get the correct message from a list of corrupted messages. The corrected
     * message is retrieved by getting the most common character in each of the
     * columns.
     *
     * @param  array  $messagesArray The array of corrupted messages
     *
     * @return string                The corrected message
     */
    public function correct(array $messagesArray) : string
    {
        $correctedMessage = "";

        foreach ($messagesArray as $message) {
            for ($i = 0; $i < strlen($message); $i++) {
                if (!isset($charCounts[$i][$message[$i]])) {
                    $charCounts[$i][$message[$i]] = 0;
                }
                $charCounts[$i][$message[$i]]++;
            }
        }

        foreach ($charCounts as $column) {
            arsort($column);
            $correctedMessage .= current(array_keys($column));
        }

        return $correctedMessage;
    }
}
