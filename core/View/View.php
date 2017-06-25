<?php

namespace Core\View;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class View
{
    public static function init()
    {
        $loader = new FilesystemLoader($_SERVER['DOCUMENT_ROOT'] . getenv('VIEWS_STORAGE'));
        $paths = [];

        if (getenv('APP_ENV') === 'production')
            $paths['cache'] = $_SERVER['DOCUMENT_ROOT'] . '/storage/cache/views';

        return new Environment($loader, $paths);
    }
}