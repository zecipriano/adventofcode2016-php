<?php

namespace AdventOfCode2016\Day09;

use AdventOfCode2016\Utils\FileReader;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Day09Command extends Command
{
    protected function configure(): void
    {
        $this->setName('day09')
            ->setDescription('Day 09: Explosives in Cyberspace')
            ->addArgument(
                'input',
                InputArgument::REQUIRED,
                'The file with the input.'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $file = new FileReader($input->getArgument('input'));
        } catch (Exception) {
            $output->writeln("<error>Can\'t read the file.</error>");
            return Command::FAILURE;
        }

        $string = $file->getString();

        $decompressor = new Decompressor();
        $decompressedLength = $decompressor->decompressedLength($string);
        $output->writeln("<info>The decompressed length is " .
            "$decompressedLength.</info>");

        $improvDecompLength = $decompressor->decompressedLength($string, true);
        $output->writeln("<info>The decompressed length using the improved " .
            "format is $improvDecompLength.</info>");

        return Command::SUCCESS;
    }
}
