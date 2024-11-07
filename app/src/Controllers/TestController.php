<?php

namespace App\Controllers;

use App\Framework\Cache\RedisCache;
use App\Framework\Controller;

class TestController extends Controller
{


    public function test()
    {
        $redis = new RedisCache ;
        $keys= $redis->getKeys();

        sort($keys);
        tt($keys);
        foreach($keys as $key){
            tt();
            tt('/************************/');
            tt($key);
            tt($redis->get($key) );
        }
    }

    public function testSingle($param1)
    {
//        trace(" testSingle($param1)");
//        trace($param1);

        return $param1;

    }

    public function testDouble($param1, $param2)
    {
       // trace("testDouble($param1, $param2)");

        //return compact('param1', 'param2');
        return [$param1, $param2];

    }






}
