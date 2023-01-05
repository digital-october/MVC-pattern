<?php

use Core\Registry;

function view($path)
{
    return Registry::view()->render($path);
}