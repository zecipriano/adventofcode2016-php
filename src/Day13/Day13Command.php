<?php

namespace AdventOfCode2016\Day13;

use AdventOfCode2016\Day13\FloorLayout;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Day13Command extends Command
{
    protected function configure()
    {
        $this->setName('day13')
            ->setDescription('Day 13: A Maze of Twisty Little Cubicles')
            ->addArgument(
                'input',
                InputArgument::REQUIRED,
                'The input (an integer).'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $seed =  intval($input->getArgument('input'));

        $layout = new FloorLayout($seed);
        $steps = $layout->shortestPath([1, 1], [31, 39]);
        $reach = $layout->reachableCoordinates([1,1], 50);

        $output->writeln("Steps to reach [31, 39]: <info>$steps</info>");
        $output->writeln("Coordinates reachable in 50 steps: <info>$reach</info>");
    }
}
