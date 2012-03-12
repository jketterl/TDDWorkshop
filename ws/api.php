<?php
use Storage\CsvStorage;
require_once(__DIR__ . '/../bootstrap.php');

use Json\Codec;
use Posts\PostList;

header('Content-Type:application/json');

$storage = new CsvStorage('Posts\Post', __DIR__ . '/../posts.csv', Array('text'));
$posts = $storage->findAll();

$json = new Codec();
echo $json->encode($posts);