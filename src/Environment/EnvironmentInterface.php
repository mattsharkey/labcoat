<?php

namespace Labcoat\Environment;

use Labcoat\Fixture\FixtureInterface;

interface EnvironmentInterface
{
    public function render(FixtureInterface $fixture);
}