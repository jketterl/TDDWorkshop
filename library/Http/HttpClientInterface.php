<?php
namespace Http;

interface HttpClientInterface
{
    public function get($url);
    public function put($url, Array $data);
    public function post($url, Array $data);
    public function delete($url);
}