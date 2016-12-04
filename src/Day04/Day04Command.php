<?php

namespace AdventOfCode2016\Day04;

use AdventOfCode2016\Utils\FileReader;
use AdventOfCode2016\Day04\Room;
use AdventOfCode2016\Day04\Decryptor;
use AdventOfCode2016\Day04\RoomStringParser;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Day04Command extends Command
{
    protected function configure()
    {
        $this->setName('day04')
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
        $parser = new RoomStringParser();
        $room = new Room();
        $decryptor = new Decryptor();
        $sum = 0;

        foreach ($lines as $line) {
            $parsedLine = $parser->parse($line);

            if ($room->valCheckSum($parsedLine['name'], $parsedLine['checksum'])) {
                $sum += $parsedLine['id'];

                $decryptedString = $decryptor->decrypt($parsedLine['name'], $parsedLine['id']);

                if (strpos($decryptedString, "object")) {
                    $output->writeln("<info>" . $decryptedString . " [" . $parsedLine['id'] . "].</info>");
                }
            }
        }

        $output->writeln("<info>The sum of the valid room ids is $sum.</info>");
    }
}
