<?php

namespace AdventOfCode2016\Day04;

use AdventOfCode2016\Day04\Decryptor;
use AdventOfCode2016\Day04\Room;
use AdventOfCode2016\Day04\RoomStringParser;
use AdventOfCode2016\Utils\FileReader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Day04Command extends Command
{
    protected function configure()
    {
        $this->setName('day04')
            ->setDescription('Day 04: Security Through Obscurity')
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
        $parser = new RoomStringParser();
        $room = new Room();
        $decryptor = new Decryptor();
        $sum = 0;

        foreach ($lines as $line) {
            $parsed = $parser->parse($line);
            $name = $parsed['name'];
            $checksum = $parsed['checksum'];
            $id = $parsed['id'];

            if ($room->valCheckSum($name, $checksum)) {
                $sum += $id;

                $decrypted = $decryptor->decrypt($name, $id);

                if (strpos($decrypted, "object")) {
                    $output->writeln("<info>$decrypted [$id].</info>");
                }
            }
        }

        $output->writeln("<info>The sum of the valid room ids is $sum.</info>");

        return Command::SUCCESS;
    }
}
