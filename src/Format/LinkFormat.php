<?php

namespace Format;

class LinkFormat extends Format implements FormatInterface
{
    public function respond(array $array)
    {
        $responseString = '';
        // Matches domains with three letter tld's
        $regex = '/[a-z0-9.\/?:@\-_=#]+\.([a-z0-9.\/?:@\-_=#]){3}\//i';
        foreach ($array as $item) {
            switch ($item['text']) {
                case '':
                    $text = '-no text value-';
                    break;
                default:
                    $text = $item['text'];
                    break;
            }
            if ($item['href']) {
                $href = '[' . preg_replace($regex, '', $item['href']) . ']';
                $responseString .= $text. ' ' . $href . " \n";
            } else {
                $responseString .= $text . " is not a link \n";
            }
        }
        $this->output->writeln($responseString);
    }
}