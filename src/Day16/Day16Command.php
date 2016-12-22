<?php

namespace AdventOfCode2016\Day16;

use AdventOfCode2016\Day16\Data;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Day16Command extends Command
{
    protected function configure()
    {
        $this->setName('day16')
            ->setDescription('Day 16: Dragon Checksum')
            ->addArgument(
                'input',
                InputArgument::REQUIRED,
                'The input (a string).'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $initialState =  $input->getArgument('input');

        $data = new Data();

        $start = microtime(true);
        $checksum = $data->checkSum($initialState, 272);
        $end = microtime(true);
        $output->writeln("Checksum 1: <info>$checksum</info> (in " . round($end - $start, 5) . "s)");

        $start = microtime(true);
        $checksum2 = $data->checkSum($initialState, 35651584);
        $end = microtime(true);
        $output->writeln("Checksum 1: <info>$checksum2</info> (in " . round($end - $start, 5) . "s)");
    }
}
