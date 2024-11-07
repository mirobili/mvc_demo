<?php

declare(strict_types=1);

use App\Controllers\DefaultController;
use App\Controllers\TestController;
use App\DbCache ;
use App\Entities\ContractArch;
use App\Framework\Cache\RedisCache;
use PHPUnit\Framework\TestCase;
use App\Framework\Router;
//require_once 'app.php';

class RedisTest extends TestCase
{

    public function setUp():void
    {

    }

    public function tearDown():void
    {

    }

    public function test_Redis()
    {
        // 'localhost', 6379 ;
        $redis = new RedisCache();
        trace($redis->getKeys());
    }
    public function test_Redis_setkey()
    {
        $redis = new RedisCache();

        $key='test';
        $val=date('Y-m-d H:i:s');

        $redis->set( $key, $val);
        $this->assertEquals($val, $redis->get($key));
    }
}


