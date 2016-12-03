<?php

namespace AdventOfCode2016\Day03;

use AdventOfCode2016\Utils\FileReader;
use AdventOfCode2016\Day03\TriangleValidator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Day03Command extends Command
{
    protected function configure()
    {
        $this->setName('day03')
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

        $validator = new TriangleValidator();
        $validTriangles = 0;

        foreach ($lines as $triangleSides) {
            $side1 = intval(strtok($triangleSides, " "));
            $side2 = intval(strtok(" "));
            $side3 = intval(strtok(" "));

            if ($validator->validate($side1, $side2, $side3)) {
                $validTriangles++;
            }
        }

        $output->writeln("<info>There are $validTriangles valid triangles.</info>");
    }
}
