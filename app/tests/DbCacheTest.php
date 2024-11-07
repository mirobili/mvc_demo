<?php

declare(strict_types=1);

use App\Controllers\DefaultController;
use App\Controllers\TestController;
use App\DbCache ;
use App\Entities\ContractArch;
use PHPUnit\Framework\TestCase;
use App\Framework\Router;
//require_once 'app.php';

class DbCacheTest extends TestCase
{

        public function setUp():void
    {

    }

    public function tearDown():void
    {

    }

    public function test_DbCache(){

            $db = new DbCache();
            $tables= $db->getTables();

            $this->assertIsArray( $tables );
            //trace($tables);
    }

    public function test_DbCache_addTables(){
        $tableName =  'customer';
        $tableData = [
                'customers'=>[
                    'fields'=>['id','name','address','phone','email','created_at','updated_at']
                    ,'readonly'=>['email'] // Add table specific readonly fields
                    ,'references' => [
                            // add References here
                        'contract'=>[ 'id','has many','contract.customer_id']
                    ]
                ]
        ];


        $db = new DbCache();
        $db->addTables($tableData) ;
        $tables= $db->getTables();

        $this->assertArrayHasKey('customers',$tables);
        $this->assertEquals($tableData['customers'],$tables['customers']);
    }

    public function test_DbCache_Generate_Classes(){

         $db = new DbCache();
        $tables= $db->getTables();

        foreach($tables as $tableName => $tableDescription){
            if($tableName!='contract_arch') continue;
            $class = $db->generateClass($tableName, $tableDescription);
            trace($class);

            $this->assertIsString( $class );
        }

    }



    public function test_ContractArch(){

        $contract = ContractArch::get(4);

        trace($contract);

    }
    public function test_ContractArch_clone(){

        $contract = ContractArch::get(1);
        $contract_clone = clone $contract;
        $contract_clone->setCode($contract_clone->getCode().'------2');
        $contract_clone->setStatus('Deactivate');

        $contract->setStatus('Deactivate');
        $contract->save();

        $contract_clone->setId('');
        $contract_clone->setCode('Coloning');


        // trace($contract_clone::class);

        $contract_clone->save();


        trace($contract);
//        trace($contract_clone);

    }
}

