<?php

namespace AdventOfCode2016\Day11;

trait ArrangementIdentifier
{
    public function identifier(array $arrangement) : string
    {
        return "E" . $arrangement['elevator'] . " " . implode(" ", $arrangement['objects']);
    }
}
