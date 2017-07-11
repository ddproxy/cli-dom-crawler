<?php

namespace Format;

use Symfony\Component\Console\Output\OutputInterface;

abstract class Format
{
    /**
     * @var OutputInterface
     */
    public $output;

    /**
     * @param OutputInterface $output
     */
    public function __construct(OutputInterface $output) {
        $this->output = $output;
    }
}