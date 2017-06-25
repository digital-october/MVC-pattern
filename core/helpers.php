<?php

function view( $path ) {
    return \Core\Registry::view()->render($path);
}