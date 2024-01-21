<?php

namespace AdventOfCode2016\Day10;

use AdventOfCode2016\Utils\FileReader;
use AdventOfCode2016\Day10\Factory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Day10Command extends Command
{
    protected function configure()
    {
        $this->setName('day10')
            ->setDescription('Day 10: Balance Bots')
            ->addArgument(
                'input',
                InputArgument::REQUIRED,
                'The file with the input.'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $file =  new FileReader($input->getArgument('input'));
        } catch (\Exception $e) {
            $output->writeln("<error>Can\'t read the file.</error>");
            return Command::FAILURE;
        }

        $lines = $file->getArrayOfLines();

        $factory = new Factory();

        foreach ($lines as $instruction) {
            $factory->dispatchInstruction($instruction);
        }

        $calc = $factory->getOutput(0)->getReceivedValues()[0] *
                $factory->getOutput(1)->getReceivedValues()[0] *
                $factory->getOutput(2)->getReceivedValues()[0];

        $output->writeln("output 0 * output 1 * output 2 = " . $calc);

        return Command::SUCCESS;
    }
}
