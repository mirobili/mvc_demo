<?php

namespace App\Storage;

use App\Framework\Cache\RedisCache;
use App\Framework\DB;
use App\Framework\Repositories\MySqlRepository;

class Storage
{
//    public static function getReporsitory(string $model_class_name)
//    {
//        return new MySqlRepository();
//    }

    private static $cache= 'RedisCache';


    public static function findByID(string $model_class_name, $id): object
    {

        $table = $model_class_name::getTableName();
        $row = DB::getByID("SELECT * FROM $table where id =:id ", $id);

        $entity = $model_class_name::makeFromArray($row);

        return $entity;

    }

    public static function find(string $model_class_name, array $criteria): array
    {

        trace("--------------------- find --------------");

        $table = $model_class_name::getTableName();
        $wher_str ='';
        if ($criteria) {
            foreach ($criteria as $key => $value) {
                //$wher[] = " $key = :$key ";
                $wher[] = " $key like :$key ";
            }

            $wher_str = implode(' and ', $wher);
            $wher_str =  ' where '. $wher_str ;
        }

        $qry = "SELECT * FROM $table  $wher_str ";

        $json=json_encode([$qry, $criteria]);

//        $key=md5($json);
        $key=($json);

        trace($key);

        $cache = new RedisCache();


        if($cache->exists($key)) {

            tt("get from cache : " . $key);
            $json = $cache->get($key) ;
            
            tt($json);
            
            $res = json_decode($json, true );
        }else{
            tt("key:$key not found in cache");
            $res = DB::query($qry, $criteria);
            if($res) {
                $cache->set($key, json_encode($res));
            }

        }

        $data = [];
        foreach ($res as $row) {
            $data[] = $model_class_name::makeFromArray($row);
        }



        return $data;
    }


    public static function save(\App\Framework\Entity $entity)
    {


        $table_name = $entity::class::table_name();

        $id = $entity->getId();

        $toArray = $entity->toArray();

        foreach($toArray as $key=>$vv) {
            if(!in_array($key, $entity::class::fillable()) ) {
                 unset($toArray[$key]);
            }
            if(in_array($key, $entity::class::readonly())){
                 unset($toArray[$key]);
             }
        }// ()$

        unset($toArray['created_at']);
        unset($toArray['updated_at']);

        if ($entity->getId()) {
            $id = $entity->getId();
            self::update($table_name, $toArray);
        } else {
            unset($toArray['id']);
            $id = self::insert($table_name, $toArray);
            return $id;
        }
    }

    private static function update($table_name, array $params )
    {
        unset($params['created_at']);
        unset($params['updated_at']);
        $keys = array_keys($params);
        $query_params = [];
        foreach ($keys as $key) {
            $query_params [] = "$key  =  :$key  ";
        }

        $update_params_str = implode(",\n", $query_params);

        $qry = "update $table_name set 
                 $update_params_str
                where id = :id
                 ";

        DB::update($qry, $params);
    }

    private static function insert($table_name, array $toArray): int
    {
        $params = array_keys($toArray);

        foreach ($params as $param) {

            $fields[] = "$param";
            $values[] = ":$param";
        }

        $fields_str = implode(",", $fields);
        $values_str = implode(",", $values);

        $qry = "insert into $table_name ($fields_str) values ($values_str)";
      //  dd($qry);
        foreach ($toArray as $key => $value) {
            $array[$key] = (string)$value;
        }

        $id = DB::insert($qry, $array);

      //  dd($id);
        return $id;
    }
}