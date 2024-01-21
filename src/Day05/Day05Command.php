<?php

namespace AdventOfCode2016\Day05;

use AdventOfCode2016\Day05\PasswordGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Day05Command extends Command
{
    protected function configure()
    {
        $this
            ->setName('day05')
            ->setDescription('Day 05: How About a Nice Game of Chess?')
            ->addArgument('doorID', InputArgument::REQUIRED, 'The door ID.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $doorID = $input->getArgument('doorID');

        $generator = new PasswordGenerator();
        $passwords = $generator->generate($doorID);

        $output->writeln(
            "<info>The password is " . $passwords['password'] . ".</info>"
        );

        $output->writeln(
            "<info>The improved password is " . $passwords['improvedPassword'] .
            ".</info>"
        );

        return Command::SUCCESS;
    }
}
