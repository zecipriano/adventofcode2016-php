<?php

namespace AdventOfCode2016\Day06;

use AdventOfCode2016\Utils\FileReader;
use AdventOfCode2016\Day06\MessageCorrector;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Day06Command extends Command
{
    protected function configure()
    {
        $this->setName('day06')
            ->addArgument(
                'input',
                InputArgument::REQUIRED,
                'The file with the input string.'
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

        $correctedMessage = $corrector->correct($lines);
        $correctedMessageLeastCommon = $corrector->correctLeastCommon($lines);

        $output->writeln("<info>The corrected message is $correctedMessage</info>");
        $output->writeln("<info>The corrected message (with the least common char method) is $correctedMessageLeastCommon</info>");
    }
}
