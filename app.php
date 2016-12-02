<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;

use AdventOfCode2016\Day01\Day01Command;
use AdventOfCode2016\Day02\Day02Command;

$application = new Application();

// Commands
$application->add(new Day01Command());
$application->add(new Day02Command());

$application->run();
