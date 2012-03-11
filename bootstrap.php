<?php
spl_autoload_register(
    function($name){
        $dir = __DIR__ . '/library/';
        $dir .= implode(DIRECTORY_SEPARATOR, explode('\\', $name)) . '.php';
        if (!file_exists($dir)) return false;
        require_once($dir);
    }
);