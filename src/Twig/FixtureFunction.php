<?php

namespace Labcoat\Twig;

use Labcoat\Fixture\FixtureCollectionInterface;

class FixtureFunction extends \Twig_SimpleFunction implements FixtureFunctionInterface
{
    /**
     * @var FixtureCollectionInterface
     */
    private $fixtures;

    public function __construct(FixtureCollectionInterface $fixtures)
    {
        $this->fixtures = $fixtures;
        parent::__construct('_fixture', [$this, 'getFixtureContext']);
    }

    public function getFixtureContext($name)
    {
        return $this->fixtures->getFixture($name)->getContext();
    }
}