<?php


namespace AppBundle;


class Weight {

  protected $kg = 0;

  protected $mv = 0;

  public function setKg($kg) {
    $this->kg = $kg;

    return $this;
  }

  public function getKg() {
    return $this->kg;
  }

  public function setMv($mv) {
    $this->mv = $mv;

    return $this;
  }

  public function getMv() {
    return $this->mv;
  }

}