<?php

namespace Commands;

use GuzzleHttp\Client;
use Monolog\Handler\PHPConsoleHandler;
use Monolog\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class ListNodes extends Command
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName('list-nodes')
            ->addArgument('url', InputArgument::REQUIRED, 'URL to scrape and crawl.')
            ->addArgument('node', InputArgument::REQUIRED, 'What nodes to list')
            ->addArgument('attr', InputArgument::REQUIRED, 'What attributes of the node to list, comma separated')
            ->setDescription('List nodes in document');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $logger = new Logger('console-logger');
        $logger->pushHandler(new PHPConsoleHandler());

        $url = $input->getArgument('url');
        $node = $input->getArgument('node');
        $client = new Client();

        $response = $client->request('GET', $url);

        $crawler = new Crawler((string)$response->getBody());
        $table = new Table($output);
        $attributes = explode(',', $input->getArgument('attr'));

        $table->setHeaders(array_merge(['text'], $attributes));

        $crawler
            ->filter($node)
            ->each(function (Crawler $element, $i) use ($logger, $attributes, $table) {
                $logger->addInfo('Element found', ['element' => (array)$element, 'index' => $i]);
                $row = [];
                $row['text'] = $element->text();
                foreach ($attributes as $attr) {
                    $row[$attr] = $element->attr($attr);
                }
                $table->addRow($row);

            });
        $table->render();
    }
}