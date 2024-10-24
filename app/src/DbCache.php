<?php

namespace App;

class DbCache
{

    // protected $readonly = ['id', 'created_at', 'updated_at'];

    protected $tables = [
        'customer' => [
            'fields' => ['id', 'name', 'address', 'phone', 'email', 'created_at', 'updated_at']
            , 'readonly' => ['email'] // Add table specific readonly fields
            , 'references' => [
                'contract' => ['id', 'has many', 'contract.customer_id']
            ]
        ]
        , 'contract' => [
            'fields' => ['id', 'code', 'customer_id', 'start_date', 'end_date', 'status', 'created_at', 'updated_at']
            , 'readonly' => [ 'created_at', 'updated_at']
            , 'references' => [
                'customer' => ['customer_id', 'hasOne', 'customer.id']
            ]
        ]

        , 'contract_arch' => [
            'fields' => ['id', 'code', 'customer_id', 'valid_from', 'valid_to', 'status', 'created_at', 'updated_at']
            , 'readonly' => [  'created_at', 'updated_at']
            , 'references' => [
                'customer' => ['customer_id', 'hasOne', 'customer.id'],

            ]
        ]

        , /// add new Entity tables here
    ];


    public function addTables($tablesMetadata)
    {

        foreach ($tablesMetadata as $tableName => $tableDescription) {
            if (isset($this->tables[$tableName])) {

                $str = "Table $tableName already exists";
                trace($str);
                throw new \Exception($str);
            }

            $this->tables[$tableName] = $tableDescription;
        }
    }

    public function getTables()
    {
        return $this->tables;
    }

    public function getTable($table)
    {
        try {
            return $table = $this->tables[$table];
        } catch (\Exception $e) {
            return null;
        }
    }


    public function save_entity_file($file, $content)
    {

        if (file_exists($file)) {
            $str = 'File already exists: ' . $file;
            trace($str);
            return $str;
        }

        if (file_exists($file)) {
            rename($file, $file . '-' . date('YmdHis') . '.bak');
        }

        file_put_contents($file, $content);
    }


    public function generateClass(int|string $_table_name, mixed $tableDescription)
    {
        //$fillable = "'id', 'name', 'address', 'phone', 'email','created_at','updated_at'";

        $_fillable = '';
        foreach ($tableDescription['fields'] as $field) {
            $_fillable .= "'$field',"; // $table;
        }

        $readonly_fields_str = '';
        foreach ($tableDescription['readonly'] as $field) {
            $readonly_fields_str .= "'$field',"; // $table;
        }

        $construct_params_array = [];
        $construct_body = '';
//
//        foreach ($tableDescription['fields'] as $field) {
//            $readonly_str= in_array($field, $tableDescription['readonly']) ? ' readonly string ' : '';
//            //$construct_params_array[]= "protected $readonly_str $$field ";
//            //$construct_body.='              $this->$field = $'.$field.'; '."\n";
//        }

        $construct_params = implode(', ', $construct_params_array);
        // $table;

        $fields_declarations = '';

        $setters = [];
        $getters = [];
        foreach ($tableDescription['fields'] as $field_name) {

            # moved to constructor property promotion

            //  $readonly_attr = in_array($field_name, $tableDescription['readonly']) ? ' readonly' : '';
            $readonly_attr = '';

            $fields_declarations .= "\n" . '        protected' . $readonly_attr . ' $' . $field_name . ' = null;';

            //. ', ' . $tableDescription['readonly'] ?? '';
            $accessorFieldName = $this->ucfirstWithDashes($field_name);

            $setters[] = 'public function set' . $accessorFieldName . '($value):void { $this->' . $field_name . ' = $value; }';
            $getters[] = 'public function get' . $accessorFieldName . '() { return $this->' . $field_name . '; }';
        }

        $setters_str = implode("\n        ", $setters);
        $getters_str = implode("\n        ", $getters);

        $_relations_str = '';
        foreach ($tableDescription['references'] as $name => $ref_descr) {

            $_relations_str .= "\n            '$name' => [\n                ";
            foreach ($ref_descr as $param => $vv) {
                $_relations_str .= "'$vv', ";
            }

            $_relations_str .= "\n" . '            ],' . "\n";
        }

//       // $readonly = "'created_at','updated_at'";
//        //$construct = protected   $id='',protected string $name='', protected string $address='',  protected string $phone='', protected string $email='', protected string $created_at='', protected string $updated_at=''
//        $references = "contracts" => [
//            'type' => 'hasMany'
//            , 'local' => 'id'
//            , 'references' => 'App\Entities\Contract.customer_id'
//        ];

        $className = $this->ucfirstWithDashes($_table_name);

        $class_file_content = '<?php

namespace App\Entities;

use App\Framework\Entity;
 
        
    class ' . $className . ' extends Entity{
                
        protected static string $_table_name = \'' . $_table_name . '\';
        
        protected static array $_fillable = [' . $_fillable . '];

        protected static array $_readonly = [' . $readonly_fields_str . '];
        
        protected static array $_relations = [' . $_relations_str . '
        ];
        
        ' . $fields_declarations . '
        
        public function __construct(' . $construct_params . ')
        {
             parent::__construct();    
            ' . "\n" . $construct_body . '
        }
        
        # Getters
        
        ' . $getters_str . ' 
        
        # Setters
        
        ' . $setters_str . ' 
        
        
    }
        
        ';

        //  dd("\n\n" . $class_file_content);
        $file = '../src/Entities/' . $className . '.php';

        $this->save_entity_file($file, $class_file_content);

        return $class_file_content;
    }


    public function ucfirstWithDashes(mixed $field_name): string|array
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $field_name)));
    }


}