<?php
require_once(__DIR__ . '/../bootstrap.php');

use Json\Codec;
use Posts\PostList;
use Validator\Profanity;

header('Content-Type:application/json');

$posts = Array();
$list = new PostList(__DIR__ . '/../posts.csv');
$validator = new Profanity();

foreach ($list as $post) {
    if ($validator->isValid($post->getText())) $posts[] = $post;
}

$json = new Codec();
echo $json->encode($posts);