<?php

// Autoload function
function myAutoload ($class) {
    $path = dirname(__DIR__) . '/classes/';
    $extension = '.class.php';
    $file = $path . $class . $extension;

    if(!file_exists($file)) {
        return false;
    }

    include $file;
}

// Register autoload function
spl_autoload_register('myAutoload');