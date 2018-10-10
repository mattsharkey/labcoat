<?php

namespace Labcoat\Fixture;

use Eloquent\Pathogen\PathInterface;

abstract class FixtureFile implements FixtureFileInterface
{
    private $path;

    public static function make(PathInterface $fixturePath)
    {
        switch ($fixturePath->extension()) {
            case 'json':
                return new JsonFixtureFile($fixturePath);
            case 'php':
                return new PhpFixtureFile($fixturePath);
            case 'yml':
            case 'yaml':
                return new YamlFixtureFile($fixturePath);
            default:
                throw new \DomainException("Unrecognized fixture type: {$fixturePath->extension()}");
        }
    }

    public function __construct(PathInterface $path)
    {
        $this->path = $path;
        if (!is_file($path->string())) {
            throw new \InvalidArgumentException("Not a file: {$path->string()}");
        }
    }

    protected function getPathAsString()
    {
        return $this->path->string();
    }
}