<?php

namespace AdventOfCode2016\Day05;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AdventOfCode2016\Day05\PasswordGenerator;

class Day05Command extends Command
{
    protected function configure()
    {
        $this
            ->setName('day05')
            ->addArgument('doorID', InputArgument::REQUIRED, 'The door ID.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $doorID = $input->getArgument('doorID');

        $generator = new PasswordGenerator();

        $password = $generator->generate($doorID);
        $improvedPassword = $generator->generateImprovedPassword($doorID);

        $output->writeln("<info>The password is $password.</info>");
        $output->writeln("<info>The improved password is $improvedPassword.</info>");
    }
}
