<?php

namespace Format;

use Symfony\Component\Console\Helper\Table;

class TableFormat extends Format implements FormatInterface
{
    public function respond(array $array)
    {
        $table = new Table($this->output);
        foreach ($array as $row) {
            $table->addRow($row);
        }
        $table->render();
    }
}