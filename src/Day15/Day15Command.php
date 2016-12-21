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

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $discConfig = [
            1 => ['nPositions' => 17, 'position' => 5],
            2 => ['nPositions' => 19, 'position' => 8],
            3 => ['nPositions' => 7,  'position' => 1],
            4 => ['nPositions' => 13, 'position' => 7],
            5 => ['nPositions' => 5,  'position' => 1],
            6 => ['nPositions' => 5,  'position' => 0],
        ];

        $discSet = new DiscSet($discConfig);
        $ballDropper = new BallDropper($discSet);

        $firstBall = $ballDropper->dropBalls();

        $output->writeln("First ball to drop: <info>$firstBall</info>");
    }
}
