<?php
require_once(__DIR__ . '/../bootstrap.php');

use Admin\UserList;
use Admin\User;
use Json\Codec;
use String\String;
use Posts\Post;
use Storage\CsvStorage;

header('Content-Type:application/json');

$postsFile = __DIR__ . '/../posts.csv';
$usersFile = __DIR__ . '/../users.csv';

try {
    if (isset($_POST['new-msg'])) {
		$post = new Post();
		$post->setUserId($_POST['userid']);
		$post->setText($_POST['new-msg']);
		$storage = new CsvStorage('Posts\Post', $postsFile, array(0 => 'userid', 1 => 'text'));
		$storage->store($post);
	} else if (isset($_POST['new-user-name'])) {
	    $user = new User();
	    $user->setName($_POST['new-user-name']);
	    $user->setPassword($_POST['new-user-password']);
	    $storage = new CsvStorage('Admin\User', $usersFile, array(0 => 'userid', 1 => 'name'));
		$storage->store($user);
	}
} catch (Exception $e) {
	$json = new Codec();
	$details = array(
		'message' => $e->getMessage()
	);
	header("HTTP/1.0 500 Internal Server Error");
	echo $json->encode($details);
	exit;
}

// read all users
$userList = new UserList($usersFile);
$users = $userList->getAll();

// collect all posts from the CSV into an array
$posts = Array();
$file = fopen($postsFile, 'r');

while (($line = fgetcsv($file, 0, ';', '"')) !== FALSE) {
    $text = new String($line[1]);
    $postUser = $userList->getById($line[0]);
    $posts[] = Array(
        'userid' => $line[0],
        'username' => $postUser->getName(),
        'text' => $text->getEllipsis()
    );
}

$frontendData = array(
    'posts' => $posts,
    'users' => $users
);

// encode array for the client
$json = new Codec();
echo $json->encode($frontendData);
