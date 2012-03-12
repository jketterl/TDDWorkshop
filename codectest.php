<?php
require_once(__DIR__ . '/bootstrap.php');
use Json\Codec;

$json = new Codec();

var_dump($json->encode(Array('das ist ein Test')));

// IMPLEMENT LESSON 1 TESTS HERE