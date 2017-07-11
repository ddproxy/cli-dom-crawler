<?php
namespace Format;

use Symfony\Component\Console\Output\OutputInterface;

interface FormatInterface
{
    /**
     * @param OutputInterface $output
     * @return mixed
     */
    public function __construct(OutputInterface $output);

    /**
     * @param array $array
     * @return mixed
     */
    public function respond(array $array);
}