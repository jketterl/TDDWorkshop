<?php
namespace Json;
require_once(__DIR__ . '/../../bootstrap.php');

class CodecTest extends \PHPUnit_Framework_TestCase
{
    // IMPLEMENT LESSON 2 HERE
}

/*

// Das ist die Musterlösung aus Lektion 1. kann nach dem Portieren entfernt werden!

$json = new Codec();

var_dump(
    $json->encode(Array('das ist ein Test')) == '["das ist ein Test"]'
);

$obj = new stdClass();
$obj->name = 'Hans Wurst';
var_dump(
    $json->encode($obj) == '{"name":"Hans Wurst"}'
);
 */