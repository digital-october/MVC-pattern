<?php

namespace Core;

class Registry
{
    static protected array $collection;

    static function __callStatic($name, $args)
    {
        return self::$collection[$name];
    }

    static public function add(array $object): void
    {
        foreach ($object as $key => $value) {
            self::$collection[$key] = $value;
        }
    }

    static public function getAll(): array
    {
        return self::$collection;
    }
}