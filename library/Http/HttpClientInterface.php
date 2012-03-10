<?php
namespace Http;

interface HttpClientInterface
{
    public function get($url);
    public function put($utl, Array $data);
    public function post($url, Array $data);
    public function delete($url);
}