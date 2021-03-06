<?php

namespace Labcoat\Patterns;

use Labcoat\Item;

class PseudoPattern extends Item implements HasDataInterface, PseudoPatternInterface {

  use HasDataTrait;

  protected $pattern;
  protected $time;
  protected $variant;

  public function __construct(PatternInterface $pattern, $variant, $dataFile) {
    $this->pattern = $pattern;
    $this->variant = $variant;
    $this->path = $pattern->getPath() . "~{$variant}";
    $this->id = $this->path;
    $this->name = $pattern->getName() . ' ' . str_replace('-', ' ', $variant);
    $this->dataFiles = [$dataFile];
  }

  public function getFile() {
    return $this->pattern->getFile();
  }

  public function getIncludedPatterns() {
    return $this->pattern->getIncludedPatterns();
  }

  public function getPartial() {
    return $this->pattern->getPartial() . '-' . $this->getVariantName();
  }

  public function getPattern() {
    return $this->pattern;
  }

  public function getPseudoPatterns() {
    return [];
  }

  public function getState() {
    return $this->pattern->getState();
  }

  public function getTemplate() {
    return $this->pattern->getTemplate();
  }

  public function getTime() {
    if (!isset($this->time)) {
      $this->time = max($this->pattern->getTime(), $this->getDataTime());
    }
    return $this->time;
  }

  public function getVariantName() {
    return $this->variant;
  }
}