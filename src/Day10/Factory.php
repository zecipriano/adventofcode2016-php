<?php

namespace AdventOfCode2016\Day10;

class Factory
{
    protected array $bots;
    protected array $outputs;
    protected InstructionParser $parser;

    public function __construct()
    {
        $this->bots = [];
        $this->outputs = [];
        $this->parser = new InstructionParser();
    }

    /**
     * Parses the instruction and dispatches it to the appropriate function.
     *
     * @param string $instruction The string with the instruction.
     */
    public function dispatchInstruction(string $instruction): void
    {
        $parsed = $this->parser->parse($instruction);

        switch ($parsed['type']) {
            case 'value':
                $this->giveValueToBot($parsed['value'], $parsed['bot']);
                break;
            case 'gives':
                $this->setReceivers($parsed['originBot'], $parsed['low'], $parsed['high']);
                break;
        }
    }

    /**
     * Gives the given $value to the given $bot. If the bot doesn't exist yet,
     * it creates it.
     *
     * @param int $value The value to give.
     * @param int $bot The bot ID.
     */
    protected function giveValueToBot(int $value, int $bot): void
    {
        if (! isset($this->bots[$bot])) {
            $this->bots[$bot] = new Bot("bot $bot");
        }

        $this->bots[$bot]->receivesValue($value);
    }

    /**
     * Sets the given $originBot receivers. If the bot doesn't exist yet,
     * it creates it.
     *
     * @param int $originBot The giver bot ID.
     * @param array $low An array with the low receiver type and its ID.
     * @param array $high An array with the high receiver type and its ID.
     */
    protected function setReceivers(int $originBot, array $low, array $high): void
    {
        if (! isset($this->bots[$originBot])) {
            $this->bots[$originBot] = new Bot("bot $originBot");
        }

        $lowReceiver = $this->getReceiverObject($low);
        $highReceiver = $this->getReceiverObject($high);

        $this->bots[$originBot]->setReceivers($lowReceiver, $highReceiver);
    }

    /**
     * Get the receiver object according to its type. If the object does not
     * exist yet, it creates it.
     *
     * @param array $receiver An array with the receiver type and its ID.
     *
     * @return Receiver The Receiver object
     */
    protected function getReceiverObject(array $receiver): Receiver
    {
        if ($receiver[0] === 'bot') {
            if (! isset($this->bots[$receiver[1]])) {
                $this->bots[$receiver[1]] = new Bot("bot $receiver[1]");
            }

            return $this->bots[$receiver[1]];
        }

        if (! isset($this->outputs[$receiver[1]])) {
            $this->outputs[$receiver[1]] = new Output("output $receiver[1]");
        }

        return $this->outputs[$receiver[1]];
    }

    /**
     * Get the bot with the given $number.
     *
     * @param int $number The bot ID.
     *
     * @return Bot         The bot with the $number ID.
     */
    public function getBot(int $number): Bot
    {
        return $this->bots[$number];
    }

    /**
     * Get the output with the given $number.
     *
     * @param int $number The output ID.
     *
     * @return Output         The Output with the $number ID.
     */
    public function getOutput(int $number): Output
    {
        return $this->outputs[$number];
    }
}
