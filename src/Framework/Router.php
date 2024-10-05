<?php

namespace App\Framework;


class Router
{
    private static array $server = [];


    public static function get(string $route, string $controller_class, string $action, $params)
    {

        //trace("get(string $route, string $class, string $action, \$params))");
        //trace($params);
        //trace('/****************************************************/');

        $path = explode('?', self::$server['REQUEST_URI'])[0] ?? '';

         trace("|$path|");

        if (self::$server["REQUEST_METHOD"] == "GET" && $path == $route) {
            $controller = new $controller_class();
            echo $controller->$action($params);
            exit;
        } else {
             trace("|$path| no match |$route| " . self::$server["REQUEST_METHOD"] );
//             do nothing
//             pass through
        }

    }


    private static function route_match($method, $route){

        $path = explode('?', self::$server['REQUEST_URI'])[0] ?? '';
        trace("|$path|");
        return (self::$server["REQUEST_METHOD"] == "POST" && $path == $route);
    }
//
//    public static function post(string $route, string $class, string $action, $params)
//    {
//        if (self::route_match($method, $route)) {
//            $controller = new $controller_class();
//            echo $controller->$action($params);
//            exit;
//        } else {
//            // do nothing // pass through
//        }
//    }

    public static function setServer(array $server)
    {
        self::$server = $server;
    }

//    public function handle()
//    {
//
//
//        trace($path);
//        trace($request);
//
//        require_once './routes.php';
//    }

}

//     get('/', [UserController::class, 'index']);
//    Router::get('/users', [UserController::class, 'index']);
//    Router::get('/users/create', [UserController::class, 'create']);
//    Router::get('/users/edit/{id}', [UserController::class, 'edit']);
//    Router::get('/users/show/{id}', [UserController::class, 'show']);
//    Router::get('/users/delete/{id}', [UserController::class, 'delete']);
//
//
//}