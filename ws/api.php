<?php
require_once(__DIR__ . '/../bootstrap.php');

use Json\Codec;
use String\String;
use Posts\Post;
use Storage\CsvStorage;

header('Content-Type:application/json');

$postsFile = __DIR__ . '/../posts.csv';

if (isset($_POST['new-msg'])) {
	try {
		$post = new Post();
		$post->setText($_POST['new-msg']);
		$storage = new CsvStorage('Posts\Post', $postsFile, array(0 => 'text'));
		$storage->store($post);
	} catch (Exception $e) {
		$json = new Codec();
		$details = array(
			'message' => $e->getMessage()
		);
		header("HTTP/1.0 500 Internal Server Error");
		echo $json->encode($details);
		exit;
	}
}

// collect all posts from the CSV into an array
$posts = Array();
$file = fopen($postsFile, 'r');

while (($line = fgetcsv($file, 0, ';', '"')) !== FALSE) {
    $text = new String($line[1]);
    $posts[] = Array(
        'text' => $text->getEllipsis()
    );
}

// encode array for the client
$json = new Codec();
echo $json->encode($posts);
