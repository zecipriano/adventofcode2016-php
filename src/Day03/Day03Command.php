<?php

namespace AdventOfCode2016\Day03;

use AdventOfCode2016\Day03\TriangleValidator;
use AdventOfCode2016\Utils\FileReader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Day03Command extends Command
{
    protected function configure()
    {
        $this->setName('day03')
            ->setDescription('Day 03: Squares With Three Sides')
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

        $lines = $file->getArrayOfLines();

        $validator = new TriangleValidator();
        $validTriangles = 0;
        $columnTriangles = [[], [], []];
        $validColumnTriangles = 0;

        foreach ($lines as $triangleSides) {
            // Triangle defined in a line.
            $side1 = intval(strtok($triangleSides, " "));
            $side2 = intval(strtok(" "));
            $side3 = intval(strtok(" "));

            // Triangles defined in columns.
            array_push($columnTriangles[0], $side1);
            array_push($columnTriangles[1], $side2);
            array_push($columnTriangles[2], $side3);

            // Validate the triangle defined in a line.
            if ($validator->validate($side1, $side2, $side3)) {
                $validTriangles++;
            }

            // Every 3 lines, validate the triangles defined in columns.
            if (count($columnTriangles[0]) === 3) {
                foreach ($columnTriangles as $cTriangle) {
                    $cSide1 = $cTriangle[0];
                    $cSide2 = $cTriangle[1];
                    $cSide3 = $cTriangle[2];

                    if ($validator->validate($cSide1, $cSide2, $cSide3)) {
                        $validColumnTriangles++;
                    }
                }

                // Reset the array for the next 3 lines.
                $columnTriangles = [[], [], []];
            }
        }

        $output->writeln("<info>There are $validTriangles valid triangles." .
                         "</info>");

        $output->writeln("<info>If defined in columns, there are " .
                         "$validColumnTriangles valid triangles.</info>");
    }
}
