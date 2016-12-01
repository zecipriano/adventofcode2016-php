<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;

use AdventOfCode2016\Day01\Day01Command;

$application = new Application();

// Commands
$application->add(new Day01Command());

$application->run();
