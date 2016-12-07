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
    public function correctMC(array $messagesArray) : string
    {
        return $this->correct($messagesArray, true);
    }

    /**
     * Get the correct message from a list of corrupted messages. The corrected
     * message is retrieved by getting the least common character in each of the
     * columns.
     *
     * @param  array  $messagesArray The array of corrupted messages
     *
     * @return string                The corrected message
     */
    public function correctLC(array $messagesArray) : string
    {
        return $this->correct($messagesArray, false);
    }


    /**
     * Calculate the correct message from a list of corrupted messages, using
     * the most or least common char in each column.
     *
     * @param  array   $messagesArray The array of corrupted messages
     * @param  boolean $mostCommon    Which method to use. True for most common
     *                                char in each column. False for least
     *                                common char (default = true).
     *
     * @return string                 The corrected message
     */
    protected function correct(
        array $messagesArray,
        bool $mostCommon = true
    ) : string {
        $correctedMessage = "";
        $charCounts = $this->countChars($messagesArray);

        foreach ($charCounts as $column) {
            $mostCommon ? arsort($column) : asort($column);
            $correctedMessage .= current(array_keys($column));
        }

        return $correctedMessage;
    }

    /**
     * Count the ocurrence of each char in each of the columns.
     *
     * @param  array $messagesArray The array of messages
     *
     * @return array                The array with the counts
     */
    protected function countChars(array $messagesArray) : array
    {
        $charCounts = [];

        foreach ($messagesArray as $message) {
            $this->countMessageChars($message, $charCounts);
        }

        return $charCounts;
    }

    /**
     * Increments the count of each of the $message chars in the $charCounts
     * array.
     *
     * @param string $message    The message
     * @param array  $charCounts The array thats holds the counts
     */
    protected function countMessageChars(
        string $message,
        array &$charCounts
    ) : void {
        for ($i = 0; $i < strlen($message); $i++) {
            $this->initialize($i, $message[$i], $charCounts);
            $charCounts[$i][$message[$i]] += 1;
        }
    }

    /**
     * Initialize (if not yet) the given postion of $charCounts array.
     *
     * @param int    $column     The column number
     * @param string $char       The char
     * @param array  $charCounts The array that holds the counts
     */
    protected function initialize(
        int $column,
        string $char,
        array &$charCounts
    ) : void {
        if (!isset($charCounts[$column][$char])) {
            $charCounts[$column][$char] = 0;
        }
    }
}
