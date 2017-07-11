<?php

namespace Format;


class JSONFormat extends Format implements FormatInterface
{
    public function respond(array $array)
    {
        $this->output->write(json_encode($array));
    }
}