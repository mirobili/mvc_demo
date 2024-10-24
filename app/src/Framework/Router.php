<?php

namespace App\Framework;

use App\Controllers\Rest\CustomerRestController;

use App\Controllers\IndexController;

class Router
{
    private static array $server = [];
    /**
     * @var true
     */
    private static bool $already_sent = false;
    private static array $routes = [];


    public static function getRoutes(): array
    {
        return self::$routes;
    }


    public static function route(string $method, string $route, string $controller_class, string $action = 'index', $params = [], $redirect_to = '', $is_rest = false)
    {            //  Router::route('GET', '/customer_demo/list', CustomerControllerDemo::class, 'list',  [$request]  );

        $route = (strlen($route) > 1) ? rtrim($route, '/') : $route; // trim trailing slashes

        $new_route = [
            'method' => strtoupper($method),
            'route' => $route,
            'controller' => $controller_class,
            'action' => $action,
            'params' =>  ($params),
            'redirect_to' => $redirect_to,
            'is_rest' => $is_rest
        ];

        self::$routes[] = $new_route;

    }



//    public static function dispatch($requestMethod, $requestUri)
//    {
//
//        // Normalize the URI (trim spaces, remove trailing slash if length > 1)
//        $requestUri = trim($requestUri);
//        $requestUri = (strlen($requestUri) > 1) ? rtrim($requestUri, '/') : $requestUri;
//
//        foreach (self::$routes as $routeData) {
//            // Check if the request method matches the route method
//            if (strtoupper($routeData['method']) === strtoupper($requestMethod)) {
//
//                // Replace all {param} placeholders with regex to match dynamic parameters
//                $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', $routeData['route']);
//
//                // Check if the URI matches the route pattern
//                if (preg_match("#^$pattern$#", $requestUri, $matches)) {
//
//                    // Extract controller, action, params, and redirect info from route data
//                  //  list($controller, $action, $params, $redirect_to) = [
//                        $controller = $routeData['controller'];
//                        $action     = $routeData['action'];
//                        $params     = $routeData['params'];
//                        $redirect_to= $routeData['redirect_to'];
//                    //];
//
//
//                  //  dd($params);
////                    if(!is_array($params)){
////                        $params = [$params];
////                    }
//
//                    array_shift($matches);  // Remove the full regex match
//                 //   $params = array_merge($params, $matches);  // Merge static and dynamic params
//
//                  //  trace($params);
//
//                    $args = [];
//
//                    if ($requestMethod == 'POST' || $routeData['is_rest']) {
//
//                        $args[] = $routeData['params'];
//                    } else {
//                        //                        if (is_array($params)) {
//                        //                            $args = $params;
//                        //                        } else {
//                        //                            $args[] = $params;
//                        //                        }
//
//
//
//
//
//                        foreach ($params as $key => $name) {
//                            //trace("$key, $name");
//                            $args[$name] = $matches[$key];  // Merge static and dynamic params
//                          //  $args[] = $matches[$key];  // Merge static and dynamic params
//
//                            trace($key);
//                            trace($name);
//                            $args[] = $matches[$key];  // Merge static and dynamic params
//                        }
//
//
//                        foreach ($matches as $match) {
//                           // $args[] = $match;  // Merge static and dynamic params
//                        }
//
//
//                        dd($args);
//
//
//                    }
//
//
////                     trace($args);
////                     $params = array_merge($params, $matches);  // Merge static and dynamic params
//
//
//                    // Check if the controller method exists
//                    if (!method_exists($controller, $action)) {
//                        http_response_code(404);
//                        return "404: $controller::$action doesn't exist.";
//                    }
//
//                    // Call the controller method and pass parameters
//                    //  $result = call_user_func_array([new $controller, $action], $params);
//
//                    trace($args);
//
//                    $result = call_user_func_array([new $controller, $action], $args);
//
//                    // Handle redirect if specified
//                    if ($redirect_to != '') {
//                        $redirect_to = self::replacePlaceholders($redirect_to, $result);
//                        header("Location: $redirect_to");
//                        exit;  // Stop execution after redirect
//                    } else {
//                        return $result;  // Return the result if no redirect
//                    }
//                }
//            }
//        }
//
//        // If no route matches, return 404
//        http_response_code(404);
//        return '404 Not Found';
//    }
//


















    public static function dispatch($requestMethod, $requestUri)
    {
        // Normalize the URI (trim spaces, remove trailing slash if length > 1)
        $requestUri = trim($requestUri);
        $requestUri = (strlen($requestUri) > 1) ? rtrim($requestUri, '/') : $requestUri;

        foreach (self::$routes as $routeData) {
            // Check if the request method matches the route method
            if ($routeData['method'] === strtoupper($requestMethod)) {
                // Replace all {param} placeholders with regex to match dynamic parameters
                $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', $routeData['route']);

                // Check if the URI matches the route pattern
                if (preg_match("#^$pattern$#", $requestUri, $matches)) {
                    // Extract controller, action, params, and redirect info from route data
                    list($controller, $action, $params, $redirect_to) = [
                        $routeData['controller'],
                        $routeData['action'],
                        $routeData['params'],
                        $routeData['redirect_to']
                    ];

                    array_shift($matches);  // Remove the full regex match
                     //$params = array_merge($params, $matches);  // Merge static and dynamic params
                    // $params = array_merge($matches, $params);  // Merge static and dynamic params

                     $args = [];

                    // if ($requestMethod == 'POST' || $routeData['is_rest']) {


                    if ($requestMethod != 'GET' || $routeData['is_rest']) {

                        $args[]  = $routeData['params'];
                    } else {
                        $args = array_merge($matches, $params);;
                    }

//                    if(!$params){
//                        $params = [];
//                    }
//                     $args = array_merge($matches, $params);;


                 //    trace($args);

                    // Check if the controller method exists
                    if (!method_exists($controller, $action)) {
                        http_response_code(404);
                        return "404: $controller::$action doesn't exist.";
                    }


                    // Call the controller method and pass parameters
                    //  $result = call_user_func_array([new $controller, $action], $params);
                //    dd($args);
                 //    trace("  call_user_func_array([new $controller, $action], \$args);");
                   //  trace("  call_user_func_array([new $controller, $action], \$args);");
                    $result = call_user_func_array([new $controller, $action], $args);

                    // Handle redirect if specified
                    if ($redirect_to != '') {
                        $redirect_to = self::replacePlaceholders($redirect_to, $result);
                        header("Location: $redirect_to");
                        exit;  // Stop execution after redirect
                    } else {
                        return $result;  // Return the result if no redirect
                    }
                }
            }
        }

        // If no route matches, return 404
        http_response_code(404);
        return '404 Not Found';
    }










    public static function dispatch1017($requestMethod, $requestUri)
    {
        // Normalize the URI (trim spaces, remove trailing slash if length > 1)
        $requestUri = trim($requestUri);
        $requestUri = (strlen($requestUri) > 1) ? rtrim($requestUri, '/') : $requestUri;

        foreach (self::$routes as $routeData) {
            // Check if the request method matches the route method
            if ($routeData['method'] === strtoupper($requestMethod)) {
                // Replace all {param} placeholders with regex to match dynamic parameters
                $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', $routeData['route']);

                // Check if the URI matches the route pattern
                if (preg_match("#^$pattern$#", $requestUri, $matches)) {
                    // Extract controller, action, params, and redirect info from route data
                    list($controller, $action, $params, $redirect_to) = [
                        $routeData['controller'],
                        $routeData['action'],
                        $routeData['params'],
                        $routeData['redirect_to']
                    ];

                    array_shift($matches);  // Remove the full regex match
                    //$params = array_merge($params, $matches);  // Merge static and dynamic params
                    $args = [];

                    if ($requestMethod == 'POST' || $routeData['is_rest']) {

                        $args[] = $routeData['params'];
                    } else {
                        if ($params) {
                            foreach ($params as $key => $name) {
                                $args[$name] = $matches[$key];  // Merge static and dynamic params
                            }
                        } else {
                            foreach ($matches as $match) {
                                $args[] = $match;  // Merge static and dynamic params
                            }
                        }
                    }


                    // Check if the controller method exists
                    if (!method_exists($controller, $action)) {
                        http_response_code(404);
                        return "404: $controller::$action doesn't exist.";
                    }

                    // Call the controller method and pass parameters
                    //  $result = call_user_func_array([new $controller, $action], $params);
                    $result = call_user_func_array([new $controller, $action], $args);

                    // Handle redirect if specified
                    if ($redirect_to != '') {
                        $redirect_to = self::replacePlaceholders($redirect_to, $result);
                        header("Location: $redirect_to");
                        exit;  // Stop execution after redirect
                    } else {
                        return $result;  // Return the result if no redirect
                    }
                }
            }
        }

        // If no route matches, return 404
        http_response_code(404);
        return '404 Not Found';
    }

    public static function dispatch_OR($requestMethod, $requestUri)
    {

        //return (self::$routes);

//
//        $requestUri = rtrim(trim($requestUri), '/');
//
        $requestUri = trim($requestUri);
        # removing trailing slashes '/'
        $requestUri = (strlen($requestUri) > 1) ? rtrim($requestUri, '/') : $requestUri;

        //return "$requestMethod, $requestUri";
        //  return json_encode(self::$routes);
        foreach (self::$routes as $routeData) {
            // Check if the request method matches the route method
            if ($routeData['method'] === strtoupper($requestMethod)) {
                // Replace all {param} with regex to match dynamic parameters
                $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', $routeData['route']);

                // Check if the URI matches the route pattern
                if (preg_match("#^$pattern$#", $requestUri, $matches)) {


                    // dd($routeData);

                    list($controller, $action, $params, $redirect_to) = [$routeData['controller'], $routeData['action'], $routeData['params'], $routeData['redirect_to']];
                    array_shift($matches);  // Remove the full match
                    $params = array_merge($params, $matches);  // Combine fixed params with dynamic ones

//                    trace("call_user_func_array([new $controller, $action], \$params);");
//                    trace( $params);

                    if (!method_exists($controller, $action)) {
                        http_response_code(404);
                        return "404 :  $controller, $action doesn't exist";
                    }
                    $result = call_user_func_array([new $controller, $action], $params);
                    if ($redirect_to != '') {
                        $redirect_to = self::replacePlaceholders($redirect_to, $result);

                        // Perform the redirect
                        header("Location: $redirect_to");
                        exit;  // Stop further execution after the redirect
                    } else {
                        return $result;
                    }
                }
            }
        }

        // return (new IndexController())->notFound();
        http_response_code(404);
        return '404 Not Found';
    }

    private static function replacePlaceholders($url, $result)
    {
        return preg_replace_callback('/\{([a-zA-Z0-9_]+)\}/', function ($matches) use ($result) {
            $key = $matches[1];  // e.g., "id" or "address"
            return isset($result[$key]) ? $result[$key] : $matches[0];  // Replace with value or keep placeholder
        }, $url);
    }

    public static function get(string $route, string $controller_class, string $action = 'index', array $params = [], string $redirect_to = '')
    {
        return self::route('get', $route, $controller_class, $action, $params, $redirect_to);
    }

    public static function post(string $route, string $controller_class, string $action, $params, string $redirect_to = '')
    {
        return self::route('post', $route, $controller_class, $action, $params, $redirect_to);
    }

    public static function getRoute(string $method, string $uri)
    {
        $routes = self::$routes;
        foreach ($routes as $route) {
            if ($route['method'] === strtoupper($method) && $route['route'] === $uri) {
                $route['params']= json_decode($route['params'],0);
                return $route;
            }
        }

        throw new \Exception('Route not found');
    }

    public static function reset()
    {
        self::$routes = [];
    }


//    private static function route_match($method, $route)
//    {
//
//        $path = explode('?', self::$server['REQUEST_URI'])[0] ?? '';
//        trace("|$path|");
//        return (self::$server["REQUEST_METHOD"] == "POST" && $path == $route);
//    }
//

//    public static function setServer(array $server)
//    {
//        self::$server = $server;
//    }

//    public function handle()
//    {
//
//
//        trace($path);
//        trace($request);
//
//        require_once './routes.php';
//    }
    public static function handle(string $route, string $class_name, $request)
    {

        self::route('GET', $route, $class_name, 'actionGet', $request, '', true);
        self::route('POST', $route, $class_name, 'actionPost', $request, '', true);
        self::route('PUT', $route, $class_name, 'actionPut', $request, '', true);
        self::route('PATCH', $route, $class_name, 'actionPatch', $request, '', true);
        self::route('DELETE', $route, $class_name, 'actionDelete', $request, '', true);

        // var_dump($class_name::handle($request));
        // exit(0);
    }

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