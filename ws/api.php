<?php
require_once(__DIR__ . '/../bootstrap.php');

use Json\Codec;
use String\String;

header('Content-Type:application/json');

// collect all posts from the CSV into an array
$posts = Array();
$file = fopen(__DIR__ . '/../posts.csv', 'r');

while (($line = fgetcsv($file, 0, ';', '"')) !== FALSE) {
    $text = new String($line[0]);
    $posts[] = Array(
        'text' => $text->getEllipsis()
    );
}

// encode array for the client
$json = new Codec();
echo $json->encode($posts);
