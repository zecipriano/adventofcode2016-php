<?php

namespace AdventOfCode2016\Day07;

use AdventOfCode2016\Utils\FileReader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AdventOfCode2016\Day07\IPChecker;

class Day07Command extends Command
{
    protected function configure()
    {
        $this->setName('day07')
            ->setDescription('Day 07: Internet Protocol Version 7')
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

        $checker = new IPChecker();
        $countTLSSupport = 0;
        $countSSLSupport = 0;

        foreach ($lines as $address) {
            if ($checker->checkTLS($address)) {
                $countTLSSupport++;
            }

            if ($checker->checkSSL($address)) {
                $countSSLSupport++;
            }
        }

        $output->writeln("<info>$countTLSSupport addresses suport TLS.</info>");
        $output->writeln("<info>$countSSLSupport addresses suport SSL.</info>");
    }
}
