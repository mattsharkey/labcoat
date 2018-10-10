<?php

namespace Labcoat\Fixture;

class PhpFixtureFile extends FixtureFile implements PhpFixtureFileInterface
{
    public function getContext()
    {
        return include($this->getPathAsString());
    }
}