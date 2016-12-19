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
        $initialArrangement = ['elevator' => 0, 'objects' => [0, 0, 1, 2, 1, 2, 1, 2, 1, 2]];
        $output->writeln("Input: " . implode(" ", $initialArrangement['objects']));

        $start = microtime(true);
        $steps = new Steps();
        $moves = $steps->move($initialArrangement);
        $end = microtime(true);

        $output->writeln("<info>Moves 1: $moves (in " . round($end - $start, 2) ."s)</info>");

        ini_set('memory_limit', '2000M'); // Yes, its hacky. Need to optimize later.
        $initialArrangement = ['elevator' => 0, 'objects' => [0, 0, 1, 2, 1, 2, 1, 2, 1, 2, 0, 0, 0, 0]];
        $output->writeln("Input: " . implode(" ", $initialArrangement['objects']));

        $start = microtime(true);
        $steps = new Steps();
        $moves = $steps->move($initialArrangement);
        $end = microtime(true);

        $output->writeln("<info>Moves 2: $moves (in " . round($end - $start, 2) ."s)</info>");
    }
}
