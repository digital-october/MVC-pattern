<?php

namespace Core;

class Registry
{
    static protected $collection;


    static function __callStatic($name, $args)
    {
        return self::$collection[$name];
    }


    static public function add(array $object)
    {
        foreach ($object as $key => $value) {
            self::$collection[$key] = $value;
        }
    }


    static public function getAll()
    {
        return self::$collection;
    }
}