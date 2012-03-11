<?php
spl_autoload_register(
    function($name){
        $dir = __DIR__ . '/';
        if (preg_match('/Test$/', $name)) {
            $dir .= 'tests/';
        } else {
            $dir .= 'library/';
        }
        $dir .= implode(DIRECTORY_SEPARATOR, explode('\\', $name)) . '.php';
        if (!file_exists($dir)) return false;
        require_once($dir);
    }
);