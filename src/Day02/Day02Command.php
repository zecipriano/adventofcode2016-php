<?php

namespace AdventOfCode2016\Day02;

use AdventOfCode2016\Day02\AlternativeKeypad;
use AdventOfCode2016\Day02\NormalKeypad;
use AdventOfCode2016\Utils\FileReader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Day02Command extends Command
{
    protected function configure()
    {
        $this->setName('day02')
            ->setDescription('Day 02: Bathroom Security')
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

        $normalKeypad = new NormalKeypad();
        $altKeypad = new AlternativeKeypad();
        $normalCode = "";
        $altCode = "";

        foreach ($lines as $line) {
            $chars = str_split($line);

            foreach ($chars as $char) {
                $normalKeypad->moveCurrentButton($char);
                $altKeypad->moveCurrentButton($char);
            }

            $normalCode .= $normalKeypad->getCurrentButton();
            $altCode .= $altKeypad->getCurrentButton();
        }

        $output->writeln("<info>The normal bathroom code is $normalCode." .
                         "</info>");

        $output->writeln("<info>The alternative bathroom code is $altCode." .
                         "</info>");

        return Command::SUCCESS;
    }
}
