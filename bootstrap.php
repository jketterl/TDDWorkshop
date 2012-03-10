<?php
define('BASEPATH', __DIR__);

spl_autoload_register(
    function($name){
        $dir = __DIR__ . '/';
        if (preg_match('/Test$/', $name)) {
            $dir .= 'tests/';
        } elseif (preg_match('/bovigo/', $name)) {
            $dir .= 'externals/vfsStream/src/main/php/';
        } else {
            $dir .= 'library/';
        }
        $dir .= implode(DIRECTORY_SEPARATOR, explode('\\', $name)) . '.php';
        if (!file_exists($dir)) return false;
        require_once($dir);
    }
);