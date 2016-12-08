<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;

use AdventOfCode2016\Day01\Day01Command;
use AdventOfCode2016\Day02\Day02Command;
use AdventOfCode2016\Day03\Day03Command;
use AdventOfCode2016\Day04\Day04Command;
use AdventOfCode2016\Day05\Day05Command;
use AdventOfCode2016\Day06\Day06Command;
use AdventOfCode2016\Day07\Day07Command;
use AdventOfCode2016\Day08\Day08Command;

$application = new Application();

// Commands
$application->add(new Day01Command());
$application->add(new Day02Command());
$application->add(new Day03Command());
$application->add(new Day04Command());
$application->add(new Day05Command());
$application->add(new Day06Command());
$application->add(new Day07Command());
$application->add(new Day08Command());

$application->run();
