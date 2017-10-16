<?php

namespace AppBundle\Service;


use AppBundle\Event\WeightInsertEvent;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class WeightProcessor implements ContainerAwareInterface {

  /**
   * @var ContainerInterface|null
   */
  private $container;

  /**
   * @inheritDoc
   */
  public function setContainer(ContainerInterface $container = NULL) {
    $this->container = $container;
    $this->addListeners();
  }


  public function addListeners() {
    $dispatcher = $this->getContainer()->get('event_dispatcher');
    $dispatcher->addListener('weight.insert', array($this, 'handleWeightInsert'));
  }

  public function handleWeightInsert(WeightInsertEvent $event) {
    print 'Event weight: ' . $event->getWeight()->getKg() ."\n";
  }

  /**
   * @return ContainerInterface
   *
   * @throws \LogicException
   */
  public function getContainer() {
    return $this->container;
  }

}