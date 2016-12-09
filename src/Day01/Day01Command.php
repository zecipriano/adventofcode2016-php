<?php

namespace AdventOfCode2016\Day01;

use AdventOfCode2016\Day01\Retriever;
use AdventOfCode2016\Utils\FileReader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Day01Command extends Command
{
    protected function configure()
    {
        $this->setName('day01')
            ->setDescription('Day 01: No Time for a Taxicab')
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

        $moves = explode(", ", $file->getString());
        $retriever = new Retriever();

        foreach ($moves as $move) {
            $turnTo = $move[0];
            $distanceToGo = intval(substr($move, 1));

            $retriever->move($turnTo, $distanceToGo);
        }

        $blocks = $retriever->getDistance();
        $firstTwice = $retriever->getFirstRepeatedDistance();

        $output->writeln("<info>The Easter Bunny HQ is $blocks blocks away".
                         "</info>");

        $output->writeln("<info>The first location visited twice is " .
                         "$firstTwice blocks away</info>");
    }
}
