<?php

namespace Labcoat\Patterns;

use Labcoat\PatternLab;

class PatternSubType extends PatternSection implements PatternSubTypeInterface {

  protected $name;
  protected $type;

  public function __construct(PatternTypeInterface $type, $name) {
    $this->type = $type;
    $this->name = $name;
  }

  public function add(PatternInterface $pattern) {
    $this->addPattern($pattern);
  }

  /**
   * @param $name
   * @return PatternInterface
   * @throws \OutOfBoundsException
   */
  public function findPattern($name) {
    return $this->getPatterns()[PatternLab::stripDigits($name)];
  }

  public function getAllPatterns() {
    return $this->getPatterns();
  }

  public function getId() {
    return $this->getType()->getName() . '/' . $this->getName();
  }

  public function getName() {
    return $this->name;
  }

  /**
   * @return PatternInterface[]
   */
  public function getPatterns() {
    return $this->items;
  }

  public function getType() {
    return $this->type;
  }
}