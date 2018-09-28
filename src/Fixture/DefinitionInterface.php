<?php

namespace Labcoat\Fixture;

interface DefinitionInterface
{
    public function add($name, array $fixture);

    public function get($name);

    public function has($name);
}