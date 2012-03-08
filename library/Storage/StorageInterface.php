<?php
namespace Storage;

interface StorageInterface
{
    public function load($id);
    public function store($object);
    public function getAll();
}