<?php
namespace Storage;

interface StorageInterface
{
    public function find($id);
    public function findAll();
    public function store($object);
}