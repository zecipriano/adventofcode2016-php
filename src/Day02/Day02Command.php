<?php

namespace AdventOfCode2016\Day02;

use AdventOfCode2016\Day02\Keypad;
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

        $keypad = new Keypad();
        $code = "";

        foreach ($lines as $line) {
            $chars = str_split($line);

            foreach ($chars as $char) {
                $keypad->move($char);
            }

            $code = $code . $keypad->getCurrentButton();
        }

        $output->writeln("<info>The bathroom code is $code.</info>");
    }
}
