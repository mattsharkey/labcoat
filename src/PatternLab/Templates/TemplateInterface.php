<?php

namespace Labcoat\PatternLab\Templates;

interface TemplateInterface extends \Labcoat\Templates\TemplateInterface {

  /**
   * @return array
   */
  public function getData();

  /**
   * @return array
   */
  public function getVariants();

  /**
   * @return bool
   */
  public function hasData();

  /**
   * @return bool
   */
  public function hasVariants();
}