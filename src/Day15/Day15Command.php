<?php

namespace AdventOfCode2016\Day15;

use AdventOfCode2016\Utils\FileReader;
use AdventOfCode2016\Day15\DiscSet;
use AdventOfCode2016\Day15\BallDropper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Day15Command extends Command
{
    protected function configure()
    {
        $this->setName('day15')
            ->setDescription('Day 15: Timing is Everything');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $start = microtime(true);
        $discConfig = [
            1 => ['nPositions' => 17, 'position' => 5],
            2 => ['nPositions' => 19, 'position' => 8],
            3 => ['nPositions' => 7,  'position' => 1],
            4 => ['nPositions' => 13, 'position' => 7],
            5 => ['nPositions' => 5,  'position' => 1],
            6 => ['nPositions' => 3,  'position' => 0],
        ];

        $discSet = new DiscSet($discConfig);
        $firstBall = $discSet->findDropTime();
        $end = microtime(true);
        $output->writeln("First ball to drop 1: <info>$firstBall</info> (in " .
                         round($end - $start, 2) ."s)");

        $start = microtime(true);
        $discConfig = [
            1 => ['nPositions' => 17, 'position' => 5],
            2 => ['nPositions' => 19, 'position' => 8],
            3 => ['nPositions' => 7,  'position' => 1],
            4 => ['nPositions' => 13, 'position' => 7],
            5 => ['nPositions' => 5,  'position' => 1],
            6 => ['nPositions' => 3,  'position' => 0],
            7 => ['nPositions' => 11, 'position' => 0],
        ];

        $discSet = new DiscSet($discConfig);
        $firstBall = $discSet->findDropTime();
        $end = microtime(true);
        $output->writeln("First ball to drop 2: <info>$firstBall</info> (in " .
                         round($end - $start, 2) ."s)");

        return Command::SUCCESS;
    }
}
