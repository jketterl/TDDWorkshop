<?php
require_once(__DIR__ . '/../bootstrap.php');

use Json\Codec;
use String\String;
use Posts\Post;
use Storage\CsvStorage;

header('Content-Type:application/json');

$postsFile = __DIR__ . '/../posts.csv';

if (isset($_POST['new-msg'])) {
	$post = new Post();
	$post->setText($_POST['new-msg']);
	$storage = new CsvStorage('Posts\Post', $postsFile, array(0 => 'text'));
	$storage->store($post);
}

// collect all posts from the CSV into an array
$posts = Array();
$file = fopen($postsFile, 'r');

while (($line = fgetcsv($file, 0, ';', '"')) !== FALSE) {
    $text = new String($line[0]);
    $posts[] = Array(
        'text' => $text->getEllipsis()
    );
}

// encode array for the client
$json = new Codec();
echo $json->encode($posts);
