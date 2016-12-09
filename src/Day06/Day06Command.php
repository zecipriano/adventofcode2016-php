<?php

namespace AdventOfCode2016\Day06;

use AdventOfCode2016\Day06\MessageCorrector;
use AdventOfCode2016\Utils\FileReader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Day06Command extends Command
{
    protected function configure()
    {
        $this->setName('day06')
            ->setDescription('Day 06: Signals and Noise')
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

        $lines = $file->getArrayOfLines();

        $corrector = new MessageCorrector();

        $correctedMessageMC = $corrector->correctMC($lines);
        $correctedMessageLC = $corrector->correctLC($lines);

        $output->writeln(
            "<info>The corrected message (with the most common char method) " .
            "is:  $correctedMessageMC</info>"
        );

        $output->writeln(
            "<info>The corrected message (with the least common char method) " .
            "is: $correctedMessageLC</info>"
        );
    }
}
