<?php

namespace Labcoat\PatternLab\Styleguide\Files\Html\Patterns;

use Labcoat\Generator\Paths\Path;
use Labcoat\PatternLab\Patterns\PatternInterface;
use Labcoat\PatternLab\Styleguide\Files\Html\Page;
use Labcoat\PatternLab\Styleguide\StyleguideInterface;

class PatternPage extends Page implements PatternPageInterface {

  /**
   * @var PatternInterface
   */
  protected $pattern;

  public static function makeLineage(PatternInterface $pattern) {
    return [
      'lineagePattern' => $pattern->getPartial(),
      'lineagePath' => static::makeRelativePath($pattern->getPath()),
    ];
  }

  public static function makePatternData(PatternInterface $pattern) {
    $data = [
      'patternExtension' => 'twig',
      'cssEnabled' => false,
      'extraOutput' => [],
      'patternName' => $pattern->getName(),
      'patternPartial' => $pattern->getPartial(),
      'patternState' => $pattern->hasState() ? $pattern->getState() : '',
      'patternStateExists' => $pattern->hasState(),
      'patternDesc' => $pattern->getDescription(),
      'lineage' => self::makePatternLineage($pattern),
      'lineageR' => self::makeReversePatternLineage($pattern),
    ];
    return $data;
  }

  public static function makePatternLineage(PatternInterface $pattern) {
    $lineage = [];
    foreach ($pattern->getIncludedPatterns() as $pattern2) {
      $lineage[] = self::makeLineage($pattern2);
    }
    return $lineage;
  }

  public static function makeRelativePath($path) {
    return "../../$path";
  }

  public static function makeReversePatternLineage(PatternInterface $pattern) {
    $lineage = [];
    foreach ($pattern->getIncludingPatterns() as $pattern2) {
      $lineage[] = self::makeLineage($pattern2);
    }
    return $lineage;
  }

  public function __construct(StyleguideInterface $styleguide, PatternInterface $pattern) {
    parent::__construct($styleguide);
    $this->pattern = $pattern;
  }

  public function getContent() {
    return $this->pattern->getExample();
  }

  public function getData() {
    return self::makePatternData($this->pattern);
  }

  public function getPath() {
    $path = $this->pattern->getId();
    return new Path("patterns/$path/$path.html");
  }

  public function getPattern() {
    return $this->pattern;
  }

  public function getTime() {
    return $this->pattern->getTime();
  }

  public function getVariables() {
    return $this->pattern->getData()->toArray();
  }
}