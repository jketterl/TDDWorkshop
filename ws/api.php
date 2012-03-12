<?php
require_once(__DIR__ . '/../bootstrap.php');

use Json\Codec;

header('Content-Type:application/json');

// collect all posts from the CSV into an array
$posts = Array();
$file = fopen(__DIR__ . '/../posts.csv', 'r');

while (($line = fgetcsv($file, 0, ';', '"')) !== FALSE) {
    $posts[] = Array(
        'text' => $line[0]
    );
}

// encode array for the client
$json = new Codec();
echo $json->encode($posts);
