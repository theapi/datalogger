<?php

namespace Theapi\BathroomScalesBundle\Event;

use Theapi\BathroomScalesBundle\Weight;
use Symfony\Component\EventDispatcher\Event;

/**
 * The weight.insert event is dispatched each time a weight is input.
 */
class WeightInsertEvent extends Event {

  const NAME = 'weight.insert';

  protected $weight;

  public function __construct(Weight $weight) {
    $this->weight = $weight;
  }

  public function getWeight() {
    return $this->weight;
  }
}
