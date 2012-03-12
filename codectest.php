<?php
require_once(__DIR__ . '/bootstrap.php');
use Json\Codec;

$json = new Codec();

var_dump(
    $json->encode(Array('das ist ein Test')) == '["das ist ein Test"]'
);

$obj = new stdClass();
$obj->name = 'Hans Wurst';
var_dump(
    $json->encode($obj) == '{"name":"Hans Wurst"}'
);