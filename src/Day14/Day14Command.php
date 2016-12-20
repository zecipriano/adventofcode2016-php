<?php

namespace AdventOfCode2016\Day14;

use AdventOfCode2016\Day14\KeySearcher;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Day14Command extends Command
{
    protected function configure()
    {
        $this->setName('day14')
            ->setDescription('Day 14: One-Time Pad')
            ->addArgument(
                'input',
                InputArgument::REQUIRED,
                'The input (a string).'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $salt =  $input->getArgument('input');

        $searcher = new KeySearcher();
        $keyIndex = $searcher->searchKeys($salt, 64);

        $output->writeln("64th key index: <info>$keyIndex</info>");
    }
}
