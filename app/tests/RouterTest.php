<?php

declare(strict_types=1);

use App\Controllers\DefaultController;
use App\Controllers\TestController;
use PHPUnit\Framework\TestCase;
use App\Framework\Router;
//require_once 'app.php';

class RouterTest extends TestCase
{

        public function setUp():void
    {
        Router::reset();
    }

    public function tearDown():void
    {
        Router::reset();
    }

    public function del_testTearDown_cleaning(){

    }

    public function test_ADD_Router_route_THEN_route_is_present(){

        $method="POST";
        $uri='http://localhost:8888/DummyUri';
        $controllerClass='ControllerClassName';
        $action='index';
        $params=[];
        $redirect_to='';
        $is_rest= '';

        $expected=[
            'method' => $method,
            'route' => $uri,
            'controller' => $controllerClass,
            'action' => $action,
            'params' => $params,
            'redirect_to' => $redirect_to,
            'is_rest' => $is_rest,
        ];



        Router::route($method, $uri,  $controllerClass , $action, $params,$redirect_to);
        $actual =  Router::getRoute($method, $uri);

        trace($expected);
        trace( $actual);

        $this->assertEquals($expected, $actual);

    }

    public function test_ADD_route_using_get_THEN_route_is_present(){

        $method="GET";
        $uri='http://localhost:8888/DummyUri';
        $controllerClass='ControllerClassName';
        $action='index';
        $params=[];
        $redirect_to='';
        $is_rest = '';

        $expected=[
            'method' => $method,
            'route' => $uri,
            'controller' => $controllerClass,
            'action' => $action,
            'params' => $params,
            'redirect_to' => $redirect_to,
            'is_rest' => $is_rest,
        ];

        Router::get( $uri,  $controllerClass , $action, $params);

        $actual =  Router::getRoute($method, $uri);
        $this->assertEquals($expected, $actual);


    }

    public function test_ADD_route_using_post_THEN_route_is_present(){

        $method="POST";
        $uri='http://localhost:8888/DummyUri';
        $controllerClass='ControllerClassName';
        $action='index';
        $params=[];
        $redirect_to='redirect_path';
        $is_rest = '';
        $expected=[
            'method' => $method,
            'route' => $uri,
            'controller' => $controllerClass,
            'action' => $action,
            'params' => $params,
            'redirect_to' => $redirect_to,
             'is_rest' => $is_rest
        ];

        Router::post( $uri,  $controllerClass , $action, $params,$redirect_to);

        $actual =  Router::getRoute($method, $uri);
        $this->assertEquals($expected, $actual);

    }


    public function test_no_params(){}
    public function test_single_param(){

//            $test = (new TestController())->testDouble('param1', 'param2');
//            trace($test);
//
//            dd();


        $var1 = 'allaballa-1';
        $var2 = 'tralala-2';





//        trace(  Router::getRoute("get", '/test/single'));
//        trace(  Router::getRoute("get", '/test/single2'));
//        trace(  Router::getRoute("get", '/test/single3'));

        Router::route("get", '/test/single',  TestController::class , 'testSingle',  [$var1] );
        $res1 = Router::dispatch('get', '/test/single');
        $this->assertEquals($var1, $res1);

        Router::route("get", '/test/single2',  TestController::class , 'testSingle',  [$var1] );
        $res2 = Router::dispatch('get', '/test/single2');
        $this->assertEquals($var1, $res1);


        Router::route("get", '/test/single3',  TestController::class , 'testSingle',  ['param1' =>$var1] );
        $res3 = Router::dispatch('get', '/test/single3');
        $this->assertEquals($var1, $res3);

        $testArray = ['param1' => 'hello', 'param2' => 'welcome'];
        Router::route("get", '/test/singleArray',  TestController::class , 'testSingle',  [$testArray] );
        $res4 = Router::dispatch('get', '/test/singleArray');
        $this->assertEquals($testArray, $res4);
//        $res2 = Router::dispatch('get', '/test/double');



//        $rr =  Router::getRoute("get", '/test/double');
//        trace($rr);
    }

    public function test_double_params(){

        $var1 = 'allaballa-1';
        $var2 = 'tralala-2';

        Router::route("get", '/test/double',  TestController::class , 'testDouble', [  $var1,   $var2]);

        $res= Router::dispatch('get', '/test/double');
        $this->assertEquals([$var1,$var2], $res);
    }
}
