<?php

namespace App\Framework;

use App\Storage\Storage;
use Exception;

class Entity implements EntityInterface
{   protected  static string $_table_name = '';

    protected static array $_fillable = [];
    protected static array $_readonly = ['created_at','updated_at'];

    protected static array $_relations = [];
    protected $id= null;
    protected $_collections = [];

    public function __construct()
    {


    }

    public function __clone(){

        $class_name = static::class;
        $new_entity = new $class_name;
        foreach ($this->fillable() as $key => $value) {
            if($key == 'id') continue;
            $new_entity->$key = $this->$key;
        }
        return $new_entity;
    }


    public static function fillable() {
        return static::$_fillable;
    }
    public static function readonly() {
        return static::$_readonly;
    }

    public static function table_name() {
        if(!static::$_table_name) {
            throw new Exception('Entity $_table_name (for '. static::class .')  not set');
        }
        return static::$_table_name;
    }

    static function getTableName() {

        if(!static::$_table_name) {
            throw new Exception('Entity $_table_name (for '. static::class .')  not set');
        }
        return static::$_table_name;
    }

    public static function getEntity($class, $id)
    {
        $class='\App\Entities\\' . ucfirst(strtolower($class) );
        $entity = $class::get($id);
        return $entity;
//        return $entity->toArray();
    }

    protected static function generateAccessor($fieldName,$action='set') {
        // Split the field name by underscores
        $parts = explode('_', $fieldName);

        // Capitalize each part except the first one
        $getterName = 'set' . ucfirst(array_shift($parts));
        foreach ($parts as $part) {
            $getterName .= ucfirst($part);
        }

        return $getterName;
    }


    public function  setVar($name, $value)
    {
        if(in_array($name ,static::$_fillable)) {
            $this->$name = $value;
        }
    }
    public function getVar($name)
    {
        if(in_array($name ,static::$_fillable)) {
            return $this->$name??null;
        }
    }


    public function __isset($name)
    {
        return isset($this->$name);
    }


    public static function makeFromArray($array)
    {
        $class_name =  static::class;
        $object= new $class_name();

        foreach(static::$_fillable as $key  ){
//            if(isset($array[$key])){

//                $setter_name = self::generateAccessor($key,'set');
//                $object->$setter_name($array[$key]);
              $object->setVar( $key , $array[$key]??'');

  //          }
        }
        return $object;
    }

    public static function updateFromArray($object, $array)
    {

        foreach(static::$_fillable as $key  ){
            if(isset($array[$key])){
//                $setter_name = self::generateAccessor($key,'set');
//                $object->$setter_name($array[$key]);
               // trace("\$object->setVar( $key , \$array[$key]);");

                $object->setVar( $key , $array[$key]);
            }
        }
        return $object;

    }


    public function getId()
    {
        return $this->id;
    }

    protected function setId($id): void
    {
        $this->id = $id;
    }


    public   function getCreatedAt()
    {
        return  $this->created_at??null;
    }

    public   function getUpdatedAt()
    {
        return $this->updated_at??null;
    }

    public function toArray(): array
    {
      //  return (array)$this;

//        foreach(self::fillable() as $field){
//            $vars[$field] = $this->$field;
//        }


         $vars= get_object_vars($this);

        foreach($vars as $kk=>$vv){
            if(mb_strpos($kk,'_') === 0)
               unset($vars[$kk]);
        }

        return $vars;
    }

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }



    public function save(): void
    {

      //  dd($this->toArray());
        $id = Storage::save($this);
        if($id && !$this->getId() ){
            $this->setId($id);
        }
   }


    public static function get(?int $id=null): object
    {
        if(!$id){
            $class_name = static::class;
            return new $class_name();
//            return new static::class;
        }
        return static::findByID($id);
    }

    public static function findByID($id): object
    {
        $oo= Storage::findByID(static::class, $id);
        //dd($oo);
        return $oo;
    }


    public static function findFirst(array $criteria): object
    {
        return Storage::find(static::class, $criteria);
    }


    public static function find(array $criteria=[]): array
    {
        return Storage::find(static::class, $criteria);
    }

    public static function delete()
    {

        throw new Exception ('not implemented');
    }


    /**
     * @return array
     */
    public static function getRelations(): array
    {
        return get_called_class()::$relations;
    }

    public function loadRelations($key= null)
    {
        // parent::loadRelations(); // TODO: Change the autogenerated stub

//        protected static array $relations = [
//            "contracts" => [
//                'type' => 'hasMany'
//                , 'local' => 'id'
//                , 'references' => 'App\Entities\Contract.customer_id'
//            ]
//        ];

        foreach (static::$_relations as $name => $rel) {


            if($key && $key !== $name){
                continue;
            }
            $rel = (object)$rel;
            $ref = explode('.', $rel->references);
            $class = $ref[0];
            $field = $ref[1];

            $local_field = $rel->local;
            $getter = 'get' . ucfirst($local_field);

            switch ($rel->type) {
                case 'hasOne':
                    $this->references[$name] = Storage::find($class, [$field => $this->$getter()]);
                    break;
                case 'hasMany':
                default:
                    //$this->references[$name] = Storage::find($class, [$field => $this->$getter()]);
                    return Storage::find($class, [$field => $this->$getter()]);
                    break;

            }

        }

    }




}