<?php
require_once(__DIR__ . '/../bootstrap.php');

use Json\Codec;
header('Content-Type:application/json');

$posts = Array();
$file = fopen(__DIR__ . '/../posts.csv', 'r');
if ($file) while (($line = fgetcsv($file, 0, ';', '"')) !== FALSE) {
    $posts[] = Array(
        'text' => $line[0]
    );
}

$json = new Codec();
echo $json->encode($posts);