<?php

namespace Labcoat\Fixture;

use Symfony\Component\Yaml\Yaml;

class Definition implements DefinitionInterface, \Countable, \IteratorAggregate, \ArrayAccess
{
    private $fixtures = [];

    private $globals = [];

    public static function fromFile($path)
    {
        if (!is_file($path)) {
            throw new \Exception("File not found: $path");
        }
        return static::fromYaml(file_get_contents($path));
    }

    public static function fromYaml($yaml)
    {
        return new static(Yaml::parse($yaml));
    }

    public function __construct(array $globals = [])
    {
        $fixtures = [];
        if (isset($globals['fixtures'])) {
            if (is_array($globals['fixtures'])) {
                $fixtures = $globals['fixtures'];
            }
            unset($globals['fixtures']);
        }
        $this->globals = $globals;
        foreach ($fixtures as $name => $fixture) {
            $this->add($name, $fixture);
        }
    }

    public function add($name, array $fixture)
    {
        if (isset($fixture['name'])) {
            $name = $fixture['name'];
        } else {
            $fixture['name'] = $name;
        }
        $this->fixtures[$name] = array_replace_recursive($this->globals, $fixture);
    }

    public function count()
    {
        return count($this->fixtures);
    }

    public function get($name)
    {
        if (!isset($this->fixtures[$name])) {
            throw new \Exception("Unknown fixture: $name");
        }
        return $this->fixtures[$name];
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->fixtures);
    }

    public function has($name)
    {
        return array_key_exists($name, $this->fixtures);
    }

    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->add($offset, $value);
    }

    public function offsetUnset($offset)
    {
        unset($this->fixtures[$offset]);
    }
}