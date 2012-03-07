<?php
require_once(__DIR__ . '/../bootstrap.php');

use Json\Codec;
use Posts\PostList;
header('Content-Type:application/json');

$posts = Array();
$list = new PostList();
foreach ($list as $post) $posts[] = $post;

$json = new Codec();
echo $json->encode($posts);