<?php

namespace Labcoat\Patterns;

class Pattern implements PatternInterface {

  protected $dataFile;
  protected $file;
  protected $name;
  protected $path;
  protected $pseudoPatterns = [];
  protected $subType;
  protected $type;

  public static function isPartialName($name) {
    return false === strpos($name, '/');
  }

  public static function splitPartial($partial) {
    return explode('-', $partial, 2);
  }

  public static function splitPath($path) {
    $parts = explode('/', $path);
    if (count($parts) == 3) return $parts;
    if (count($parts) == 2) return [$parts[0], null, $parts[1]];
    throw new \InvalidArgumentException("Invalid path");
  }

  public static function stripOrdering($str) {
    list($num, $name) = explode('-', $str, 2);
    return is_numeric($num) ? $name : $str;
  }

  public function __construct($path, $file) {
    $this->path = $path;
    $this->file = $file;
    list($this->type, $this->subType, $this->name) = self::splitPath($path);
  }

  public function addPseudoPattern($name, $dataFile) {
    $this->pseudoPatterns[$name] = $dataFile;
  }

  public function getDataFile() {
    return $this->dataFile;
  }

  public function getName() {
    return $this->name;
  }

  public function getPartial() {
    return $this->getType() . '-' . $this->getName();
  }

  public function getPath() {
    return $this->path;
  }

  public function getPseudoPatterns() {
    return $this->pseudoPatterns;
  }

  public function getSubtype() {
    return $this->subType;
  }

  public function getType() {
    return $this->type;
  }

  public function hasSubtype() {
    return !empty($this->subType);
  }

  public function setDataFile($path) {
    $this->dataFile = $path;
  }
}