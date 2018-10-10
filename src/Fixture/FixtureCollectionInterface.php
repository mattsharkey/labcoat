<?php

namespace Labcoat\Fixture;

interface FixtureCollectionInterface
{
    /**
     * @param string $name
     * @return FixtureInterface
     */
    public function getFixture($name);
}