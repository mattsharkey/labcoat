<?php

namespace Labcoat\Fixture;

interface FixtureInterface
{
    public function getContext();

    public function getTemplateName();
}