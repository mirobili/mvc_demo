<?php

namespace App\Framework\Repositories;

use App\Framework\Model;
use App\Framework\RepositoryBase;
use App\Framework\RepositoryInterface;

class MySqlRepository extends RepositoryBase implements RepositoryInterface
{
    public function findAll(Model $model):array
    {
        $table = $model::class;
        $qry = "select * from $table "; // TODO: Implement findAll() method.""
        $res = $DB::select($qry);

        $array = [];
        foreach ($res as $row) {
            $array[] = $this->createModel($model::class,$row);
        }

        return $array;
    }

    public function find( $model,  $id)
    {
        // TODO: Implement find() method.
        $table = $model::class;
        $qry = "select * from $table "; // TODO: Implement findAll() method.""
        $res = $DB::select($qry);

        $array = [];
        foreach ($res as $row) {
            $array[] = $this->createModel($model::class,$row);
        }

        return $array;

        return $array;
    }
    public  function create(Model $model)
    {
        // TODO: Implement create() method.
    }
    public  function update(Model $model)
    {
        // TODO: Implement update() method.
    }
    public  function delete(Model $model)
    {
        // TODO: Implement delete() method.
    }
}