<?php

namespace AdventOfCode2016\Day12;

use AdventOfCode2016\Utils\FileReader;
use AdventOfCode2016\Day12\Computer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Day12Command extends Command
{
    protected function configure()
    {
        $this->setName('day12')
            ->setDescription('Day 12: Leonardo\'s Monorail')
            ->addArgument(
                'input',
                InputArgument::REQUIRED,
                'The file with the input.'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $file =  new FileReader($input->getArgument('input'));
        } catch (Exception $e) {
            $output->writeln("<error>Can\'t read the file.</error>");
            return;
        }

        $instructionSet = $file->getArrayOfLines();

        $computer = new Computer();
        $computer->execute($instructionSet);

        $output->writeln("a: " . $computer->getRegisterValue('a'));
    }
}
