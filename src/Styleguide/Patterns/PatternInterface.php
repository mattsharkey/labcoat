<?php

namespace Labcoat\Styleguide\Patterns;

interface PatternInterface {
  public function addIncludedPattern(PatternInterface $pattern);
  public function addIncludingPattern(PatternInterface $pattern);
  public function getContent();
  public function getData();
  public function getId();
  public function getIncludedPatterns();
  public function getName();
  public function getFile();
  public function getFilePath($extension);
  public function getLineagePath();
  public function getParentId();
  public function getPartial();
  public function getPath();
  public function getTemplate();
  public function getVariantName();
  public function isPseudo();
  public function patternCSS();
  public function patternCSSExists();
  public function patternDesc();
  public function patternDescAdditions();
  public function patternDescExists();
  public function patternEngineName();
  public function patternExampleAdditions();
  public function patternLineageExists();
  public function patternLineageEExists();
  public function patternLineageRExists();
  public function patternLineages();
  public function patternLineagesR();
  public function patternLink();
  public function patternName();
  public function patternPartial();
  public function patternPartialCode();
  public function patternPartialCodeE();
  public function patternSectionSubtype();
}
