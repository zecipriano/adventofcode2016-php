<?php

namespace AdventOfCode2016\Day08;

use AdventOfCode2016\Day08\Display;
use AdventOfCode2016\Day08\DisplayOperationParser;
use AdventOfCode2016\Utils\FileReader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class Day08Command extends Command
{
    protected function configure()
    {
        $this->setName('day08')
            ->setDescription('Day 08: Two-Factor Authentication')
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

        $display = new Display(6, 50);
        $parser = new DisplayOperationParser();

        foreach ($lines as $operation) {
            $args = $parser->parse($operation);

            switch ($args[0]) {
                case 'rect':
                    $display->rect($args[2], $args[1]);
                    break;
                case 'rotate row':
                    $display->rotateRow($args[1], $args[2]);
                    break;
                case 'rotate column':
                    $display->rotateColumn($args[1], $args[2]);
                    break;
            }
        }

        $litPixels = $display->litPixels();
        $displayPixels = $display->getDisplay();

        $lit = new OutputFormatterStyle('green', 'green');
        $off = new OutputFormatterStyle('black', 'black');
        $output->getFormatter()->setStyle('lit', $lit);
        $output->getFormatter()->setStyle('off', $off);

        $output->writeln(str_repeat("-", count($displayPixels[0])));

        $output->writeln("<info>The are $litPixels lit pixels.</info>");

        $output->writeln(str_repeat("-", count($displayPixels[0])));

        foreach ($displayPixels as $line) {
            foreach ($line as $pixel) {
                $pixel ? $output->write("<lit>#</lit>") : $output->write("<off>.</off>");
            }
            $output->writeln("");
        }

        $output->writeln(str_repeat("-", count($displayPixels[0])));
    }
}
