<?php

namespace Labcoat\Console;

use Labcoat\Generator\Generator;
use Labcoat\PatternLab\Styleguide\Styleguide;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
        $this
            ->setName('generate')
            ->setDescription("Generate a Pattern Lab")
            ->addArgument('destination', InputArgument::REQUIRED, "The destination path")
            ->addOption('src', 's', InputOption::VALUE_OPTIONAL, "The source path");
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $dest = $input->getArgument('destination');
        $src = $input->getOption('src') ?: getcwd();
        $output->writeln("<info>Creating style guide in directory $dest</info>");
        $output->writeln("<info>Using templates from directory $src</info>");
        $styleguide = new Styleguide();
        $generator = new Generator($styleguide, $dest);
        $report = $generator();
        $output->writeln($report->summary());
        $output->writeln($report->verbose(), OutputInterface::VERBOSITY_VERBOSE);
        $output->writeln("<info>Done.</info>");
    }
}