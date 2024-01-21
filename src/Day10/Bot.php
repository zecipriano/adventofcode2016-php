<?php

namespace AdventOfCode2016\Day10;

class Bot implements Receiver
{
    const int LOW = 17;
    const int HIGH = 61;

    protected Receiver $lowReceiver;
    protected Receiver $highReceiver;
    protected array $values;
    protected string $name;

    public function __construct(string $name = 'unnamed bot')
    {
        $this->values = [];
        $this->name = $name;
    }

    /**
     * Set the bot receivers. If the bot already has 2 values triggers the
     * distribution to the receivers.
     *
     * @param Receiver $lowReceiver The receiver of the lower value.
     * @param Receiver $highReceiver The receiver of the higer value.
     */
    public function setReceivers(
        Receiver $lowReceiver,
        Receiver $highReceiver
    ): void {
        $this->lowReceiver = $lowReceiver;
        $this->highReceiver = $highReceiver;

        if (count($this->values) === 2) {
            $this->giveValues();
        }
    }

    /**
     * Receives a value. If its the second triggers the distribution to the
     * receivers.
     *
     * @param int $value The value to receive.
     */
    public function receivesValue(int $value): void
    {
        // Only accept value if there is space for it.
        if (count($this->values) < 2) {
            $this->values[] = $value;
        }

        // If has two values triggers the distribution.
        if (count($this->values) === 2) {
            if (min($this->values) === self::LOW &&
                max($this->values) === self::HIGH) {
                echo $this->describe() . "\n";
            }

            $this->giveValues();
        }
    }

    /**
     * Gives the values to the receivers.
     */
    public function giveValues(): void
    {
        if ($this->lowReceiver && $this->highReceiver) {
            $this->lowReceiver->receivesValue(min($this->values));
            $this->highReceiver->receivesValue(max($this->values));

            // Resets the values array
            $this->values = [];
        }
    }

    /**
     * Returns a string describing the bot. Includes the name and the current
     * values.
     *
     * @return string A string describing the bot.
     */
    public function describe(): string
    {
        $string = "";
        $string .= $this->name . " [" . implode(", ", $this->values) . "]";

        return $string;
    }

    /**
     * Returns a string describing the bot and its receivers. Includes the name
     * and the current values.
     *
     * @return string A string describing the bot.
     */
    public function describeWithReceivers(): string
    {
        $string = $this->describe();

        if ($this->lowReceiver) {
            $string .= " ::: low: " . $this->lowReceiver->describe();
        }

        if ($this->highReceiver) {
            $string .= " ::: high: " . $this->highReceiver->describe();
        }

        return $string;
    }

    /**
     * Gets the high receiver.
     *
     * @return Receiver The high receiver.
     */
    public function getHighReceiver(): Receiver
    {
        return $this->highReceiver;
    }

    /**
     * Gets the low receiver.
     *
     * @return Receiver The low receiver.
     */
    public function getLowReceiver(): Receiver
    {
        return $this->lowReceiver;
    }
}
