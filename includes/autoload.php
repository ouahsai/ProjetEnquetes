<?php

// spl_autoload_register compatible PSR4, mieux que __autoload()
spl_autoload_register(function ($className)
{
    $classPath = __DIR__ . "\..\classes\\$className.php";
    $classPath = strtr($classPath, "\\", DIRECTORY_SEPARATOR);
    
    require_once $classPath;
});


