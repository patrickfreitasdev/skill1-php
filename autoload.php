<?php 

namespace Library;

/**
 * Autoload chasses inside Library folder
 */
spl_autoload_register(function($class){
    $class = str_replace('\\', '/', $class);
    require_once $class . '.php';
});