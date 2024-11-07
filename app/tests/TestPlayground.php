<?php

declare(strict_types=1);

use App\Controllers\DefaultController;
use App\Controllers\TestController;
use App\DbCache ;
use App\Entities\ContractArch;
use PHPUnit\Framework\TestCase;
use App\Framework\Router;
//require_once 'app.php';

class TestPlayground extends TestCase
{

        public function setUp():void
    {

    }

    public function tearDown():void
    {

    }

    public function test_customer(){

            $customer = Customer::get(1);

            trace($customer);

    }


    public function test_ContractArch(){

            $contract = ContractArch::get(1);

            trace($contract);

    }



    public function test_Memcached(){

        $cache = new \Memcached();
        $cache->addServer('localhost', '11211');

// get all stored memcached items

        $keys = $cache->getAllKeys();
        $cache->getDelayed($keys);

        $store = $cache->fetchAll();

        trace($store);

    }






}


