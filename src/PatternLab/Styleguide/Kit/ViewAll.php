<?php

namespace Labcoat\PatternLab\Styleguide\Kit;

use Labcoat\Html\Element;
use Labcoat\PatternLab\Styleguide\Files\Javascript\Variable;
use Labcoat\PatternLab\Styleguide\Kit\Partials\PatternSection;
use Labcoat\PatternLab\Styleguide\StyleguideInterface;

class ViewAll {

  protected $partial = '';

  protected $patterns = [];

  protected $styleguide;

  public function __construct(StyleguideInterface $styleguide, array $patterns = [], $partial = '') {
    $this->styleguide = $styleguide;
    $this->patterns = $patterns;
    $this->partial = $partial;
  }

  public function __toString() {
    $viewAll  = $this->getContainer();
    $viewAll .= $this->getScript();
    return $viewAll;
  }

  public function getContainer() {
    $patterns = $this->getPatternsContainer();
    return new Element('div', ['class' => 'sg-main', 'role' => 'main'], $patterns);
  }

  public function getPartial() {
    return $this->partial;
  }

  public function getPatternSections() {
    $patterns = [];
    foreach ($this->getPatterns() as $pattern) {
      $patterns[] = new PatternSection($this->styleguide, $pattern);
    }
    return $patterns;
  }

  public function getPatterns() {
    return $this->patterns;
  }

  public function getPatternsContainer() {
    $patterns = implode('', $this->getPatternSections());
    return new Element('div', ['id' => 'sg-patterns'], $patterns);
  }

  public function getScript() {
    return new Element('script', [], $this->getScriptContent());
  }

  public function getScriptContent() {
    return implode('', $this->getScriptVariables());
  }

  public function getScriptVariables() {
    return [
      new Variable('patternPartial', $this->getPartial()),
      new Variable('lineage', ''),
    ];
  }
}