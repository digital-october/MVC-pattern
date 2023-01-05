<?php

namespace Core\View;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    public static function init(): Environment
    {
        $root = __DIR__ . '/../../';
        $loader = new FilesystemLoader($root . 'app/Views');
        $paths = [];

        if (getenv('APP_ENV') === 'production') {
            $paths['cache'] = $root . '/storage/cache/views';
        }

        return new Environment($loader, $paths);
    }
}