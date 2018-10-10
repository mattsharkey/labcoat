<?php

namespace Labcoat\Fixture;

use Symfony\Component\Yaml\Yaml;

class YamlFixtureFile extends FixtureFile implements YamlFixtureFileInterface
{
    public function getContext()
    {
        return Yaml::parseFile($this->getPathAsString());
    }
}