<?php

declare(strict_types=1);

use App\Controllers\DefaultController;
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

        $expected=[
            'method' => $method,
            'route' => $uri,
            'controller' => $controllerClass,
            'action' => $action,
            'params' => $params,
            'redirect_to' => $redirect_to
        ];
        Router::route($method, $uri,  $controllerClass , $action, $params,$redirect_to);
        $actual =  Router::getRoute($method, $uri);
        $this->assertEquals($expected, $actual);

    }

    public function test_ADD_route_using_get_THEN_route_is_present(){

        $method="GET";
        $uri='http://localhost:8888/DummyUri';
        $controllerClass='ControllerClassName';
        $action='index';
        $params=[];
        $redirect_to='';

        $expected=[
            'method' => $method,
            'route' => $uri,
            'controller' => $controllerClass,
            'action' => $action,
            'params' => $params,
            'redirect_to' => $redirect_to
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

        $expected=[
            'method' => $method,
            'route' => $uri,
            'controller' => $controllerClass,
            'action' => $action,
            'params' => $params,
            'redirect_to' => $redirect_to
        ];

        Router::post( $uri,  $controllerClass , $action, $params,$redirect_to);

        $actual =  Router::getRoute($method, $uri);
        $this->assertEquals($expected, $actual);

    }


    function test_end_to_end_endpoint_from_db(){

        $url = 'http://localhost:8888/customer/list/1';
        $content = file_get_contents($url);
        $expected = '{"id":"1","name":"Miro","address":"Sofia 1000","phone":"+359 882220002","email":"miroslav.biliarski@gmail.com","created_at":"","updated_at":""}';
        $expected = '{"id":1,"name":"Miro","address":"Sofia 1000","phone":"+359 882220002","email":"miroslav.biliarski@gmail.com","created_at":"2024-10-08 22:06:34","updated_at":"2024-10-08 22:09:27"}';
        $this->assertEquals($expected, $content);

        $url = 'http://localhost:8888/customer/list/2';
        $content = file_get_contents($url);
        $expected = '{"id":2,"name":"Ivan Ivanov","address":"Sofia 1111","phone":"+359 700 12 012","email":"office@credissimo.bg","created_at":"2024-10-08 22:08:41","updated_at":"2024-10-08 22:08:41"}';
        $this->assertEquals($expected, $content);
    }
}
