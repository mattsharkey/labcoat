<?php

namespace Labcoat\Environment;

use Labcoat\Fixture\FixtureInterface;

class Environment implements EnvironmentInterface
{
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render(FixtureInterface $fixture)
    {
        try {
            return $this->twig->render($fixture->getTemplateName(), $fixture->getContext());
        } catch (\Exception $e) {
            return '<b>' . get_class($e) . '</b>:' . $e->getMessage();
        }
    }
}