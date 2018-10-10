<?php

namespace Labcoat\Fixture;

use Eloquent\Pathogen\FileSystem\FileSystemPath;
use Eloquent\Pathogen\PathInterface;

class FixtureCollectionDirectory implements FixtureCollectionDirectoryInterface
{
    private static $extensions = ['yml', 'yam', 'json', 'php'];

    /**
     * @var \Eloquent\Pathogen\PathInterface
     */
    private $root;

    public function __construct($rootPath)
    {
        $this->root = FileSystemPath::fromString($rootPath);
    }

    public function getFixture($name)
    {
        foreach (static::$extensions as $extension) {
            $fixturePath = $this->makeFixturePath($name, $extension);
            if (file_exists($fixturePath->string())) {
                return FixtureFile::make($fixturePath);
            }
        }
        throw new \OutOfBoundsException("Fixture not found: $name");
    }

    /**
     * @param string $name
     * @param string $extension
     * @return PathInterface
     */
    private function makeFixturePath($name, $extension)
    {
        $relativePath = FileSystemPath::fromString($name)->joinExtensions($extension);
        $path = $this->root->resolve($relativePath);
        if (!$this->root->isAncestorOf($path)) {
            throw new \OutOfBoundsException("Fixture not in directory: {$relativePath->string()}");
        }
        return $path;
    }
}