<?php

namespace Labcoat\Structure;

use Labcoat\Patterns\PatternInterface;

interface TypeInterface extends FolderInterface {

  public function addPattern(PatternInterface $pattern);

  /**
   * @return string
   */
  public function getId();

  /**
   * @return string
   */
  public function getName();

  /**
   * @return bool
   */
  public function hasSubtypes();
}