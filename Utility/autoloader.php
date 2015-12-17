<?php

require_once 'constants.php';

use simpleChat\Utility;

spl_autoload_register(function($class)
{    
    $class = str_replace('simpleChat', '', $class);
    $class = ltrim($class, '\\');
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    
    if(file_exists(Utility\ROOT_PATH . $class))
        require_once Utility\ROOT_PATH . $class;
});

