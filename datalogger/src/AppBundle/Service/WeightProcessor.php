<?php

namespace AppBundle\Service;


use AppBundle\Event\WeightInsertEvent;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class WeightProcessor implements ContainerAwareInterface, EventSubscriberInterface {

  /**
   * @var ContainerInterface|null
   */
  private $container;

  /**
   * @inheritDoc
   */
  public function setContainer(ContainerInterface $container = NULL) {
    $this->container = $container;
  }

  /**
   * @inheritDoc
   */
  public static function getSubscribedEvents() {
    return [
      WeightInsertEvent::NAME => 'handleWeightInsert',
    ];
  }

  public function handleWeightInsert(WeightInsertEvent $event) {
    print 'Event weight: ' . $event->getWeight()->getKg() ."\n";
  }

  /**
   * @return ContainerInterface
   */
  public function getContainer() {
    return $this->container;
  }

}
