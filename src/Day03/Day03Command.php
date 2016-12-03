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
        $columnTriangles = [[], [], []];
        $validColumnTriangles = 0;

        foreach ($lines as $triangleSides) {
            $side1 = intval(strtok($triangleSides, " "));
            array_push($columnTriangles[0], $side1);

            $side2 = intval(strtok(" "));
            array_push($columnTriangles[1], $side2);

            $side3 = intval(strtok(" "));
            array_push($columnTriangles[2], $side3);

            if ($validator->validate($side1, $side2, $side3)) {
                $validTriangles++;
            }

            if (count($columnTriangles[0]) === 3) {
                foreach ($columnTriangles as $columnTriangle) {
                    if ($validator->validate($columnTriangle[0], $columnTriangle[1], $columnTriangle[2])) {
                        $validColumnTriangles++;
                    }
                }

                $columnTriangles = [[], [], []];
            }
        }

        $output->writeln("<info>There are $validTriangles valid triangles.</info>");
        $output->writeln("<info>If defined in columns, there are $validColumnTriangles valid triangles.</info>");
    }
}
