<?php

namespace App\Framework;

class Model extends ModelInterface
{
    public function __construct()
    {
    }
    public function findAll(array $criteria= null): array
    {
        return [];
    }

    public function find($id): ModelInterface
    {
        return new Model();
    }
}