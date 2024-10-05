<?php
namespace App;

use App\Controllers\UserController;
use App\Framework\Router;
use App\Views\UserIndexView;

Router::setServer($_SERVER);


$request = $_REQUEST;
extract($request);

Router::get('/',  UserController::class , 'index' , $name ?? null);
Router::get('/user/hello',  UserController::class , 'index' , $name  ?? null);
Router::get('/user/index',  UserIndexView::class , 'render' , ['name'=>'1111111111111']  ?? null);

Router::get('/user/hello/{id}',  UserController::class , 'index' , $name2 ?? null);
Router::get('/user/hello/{id}',  UserController::class , 'default' , $name2 ?? null);

// Router::get('/users', UserController::class, 'index', $request['name'] ?? null);

//
//   dd();
//Router::get('/users/create', [UserController::class, 'create']);
//Router::get('/users/edit/{id}', [UserController::class, 'edit']);
//Router::get('/users/show/{id}', [UserController::class, 'show']);
//Router::get('/users/delete/{id}', [UserController::class, 'delete']);
//
//Router::post('/users', [UserController::class, 'create']);
//Router::put('/users/{id}', [UserController::class, 'update']);
//
//Router::delete('/users/{id}', [UserController::class, 'delete']);
//Router::get('/users/rest', [UserRestController::class, 'index']);

//Router::get('/users', [UserController::class, 'index']);
//Router::get('/users/create', [UserController::class, 'create']);
//Router::get('/users/edit/{id}', [UserController::class, 'edit']);
//Router::get('/users/show/{id}', [UserController::class, 'show']);
//Router::get('/users/delete/{id}', [UserController::class, 'delete']);
//
//Router::post('/users', [UserController::class, 'create']);
//Router::put('/users/{id}', [UserController::class, 'update']);
//
//Router::delete('/users/{id}', [UserController::class, 'delete']);
//Router::get('/users/rest', [UserRestController::class, 'index']);