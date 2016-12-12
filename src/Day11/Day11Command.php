<?php

namespace AdventOfCode2016\Day11;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AdventOfCode2016\Day11\Steps;

class Day11Command extends Command
{
    protected function configure()
    {
        $this->setName('day11')
            ->setDescription('Day 11: Radioisotope Thermoelectric Generators');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $elevatorFloor = 0;
        $objects = [0, 0, 1, 2, 1, 2, 1, 2, 1, 2];
        $steps = new Steps($elevatorFloor, $objects);
        $moves = $steps->move();
        $output->writeln("<info>Moves: $moves</info>");
    }
}
