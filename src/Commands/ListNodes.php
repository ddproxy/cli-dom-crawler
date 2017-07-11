<?php

namespace Commands;

use Format\JSONFormat;
use Format\LinkFormat;
use Format\TableFormat;
use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
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
            ->addOption('format', 'f', InputOption::VALUE_OPTIONAL, 'What attributes of the node to list, comma separated', 'table')
            ->setDescription('List nodes in document');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $url = $input->getArgument('url');
            $node = $input->getArgument('node');
            $client = new Client();

            $response = $client->request('GET', $url);
            if ($response->getStatusCode() > 300) {
                throw new \Exception("Guzzle request returned: " . $response->getReasonPhrase());
            }
            $crawler = new Crawler((string)$response->getBody());
            $attributes = explode(',', $input->getArgument('attr'));

            switch ($input->getOption('format')) {
                case 'json':
                    $outputFormat = new JSONFormat($output);
                    break;
                case 'link':
                    $outputFormat = new LinkFormat($output);
                    break;
                case 'table':
                default:
                    $outputFormat = new TableFormat($output);
                    break;
            }

            $rows = [];
            $crawler
                ->filter($node)
                ->each(function (Crawler $element, $i) use ($output, $attributes, &$rows) {
                    if ($output->getVerbosity() > OutputInterface::VERBOSITY_VERBOSE) {
                        $output->writeln(['element' => $element->html(), 'index' => $i]);
                    }
                    $row = [];
                    $row['text'] = $element->text();
                    foreach ($attributes as $attr) {
                        $row[$attr] = $element->attr($attr);
                    }
                    $rows[] = $row;
                });

            $outputFormat->respond($rows);
        } catch (\Exception $exception) {
            $output->write("Exception caught: " . $exception->getMessage() . "\n");
        }
    }
}