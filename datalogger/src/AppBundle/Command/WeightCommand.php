<?php

namespace AppBundle\Command;

use AppBundle\Event\WeightInsertEvent;
use AppBundle\Service\WeightProcessor;
use AppBundle\Weight;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class WeightCommand extends ContainerAwareCommand {

  protected function configure() {
    $this
      // the name of the command (the part after "bin/console")
      ->setName('app:weight')

      // the short description shown while running "php bin/console list"
      ->setDescription('Accepts input from the command line.')

      // the full command description shown when running the command with
      // the "--help" option
      ->setHelp('Add a data point with -w (for weight) and -b (for battery)')

      // The weight to be stored
      ->addArgument('weight', InputArgument::REQUIRED, 'The weight to record.')

      // The battery millivolts reading
      ->addOption(
        'battery',
        'b',
        InputOption::VALUE_REQUIRED,
        'The battery millivolts reading',
        3700
      );
    ;
  }

  protected function execute(InputInterface $input, OutputInterface $output) {
    $output->writeln('weight: ' . $input->getArgument('weight'));
    $output->writeln('battery: ' . $input->getOption('battery'));

    // Initialize the weight processing service.
    $this->getContainer()->get(WeightProcessor::class);

    // The data to be processed.
    $weight = (new Weight())
      ->setKg($input->getArgument('weight'))
      ->setMv($input->getOption('battery'))
    ;

    // Send the event.
    $dispatcher = $this->getContainer()->get('event_dispatcher');
    $event = new WeightInsertEvent($weight);
    $dispatcher->dispatch(WeightInsertEvent::NAME, $event);

  }
}