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
        $charCounts = $this->countChars($messagesArray);

        foreach ($charCounts as $column) {
            arsort($column);
            $correctedMessage .= current(array_keys($column));
        }

        return $correctedMessage;
    }

    /**
    * Get the correct message (with a alternative method) from a list of
    * corrupted messages. The corrected message is retrieved by getting the
    * least common character in each of the columns.
    *
     * @param  array  $messagesArray The array of corrupted messages
     *
     * @return string                The corrected message
     */
    public function correctLeastCommon(array $messagesArray) : string
    {
        $correctedMessage = "";
        $charCounts = $this->countChars($messagesArray);

        foreach ($charCounts as $column) {
            asort($column);
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
        foreach ($messagesArray as $message) {
            for ($i = 0; $i < strlen($message); $i++) {
                if (!isset($charCounts[$i][$message[$i]])) {
                    $charCounts[$i][$message[$i]] = 0;
                }
                $charCounts[$i][$message[$i]]++;
            }
        }

        return $charCounts;
    }
}
