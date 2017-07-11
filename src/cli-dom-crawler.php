#!/usr/bin/env php
<?php

require __DIR__ . '/../vendor/autoload.php';

use Commands\ListNodes;
use Symfony\Component\Console\Application;


$application = new Application();

$application
    ->add(new ListNodes())
    ->getApplication()
    ->setDefaultCommand('list-nodes', true);

$application->run();