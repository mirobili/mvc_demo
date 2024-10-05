<?php


use App\Controllers\UserController;
use App\Controllers\UserRestController;
use App\Framework\Controller;
use App\Framework\Router;
use App\Models\UserModel;
use App\Repository\Repository;
use App\Services\UserService;

$request = $_REQUEST;
extract($request);

Router::get('/', UserController::class, 'index', $request['name'] ?? null);

Router::get('/users', UserController::class, 'index', $request['name'] ?? null);

Router::get('/users/create', [UserController::class, 'create']);
Router::get('/users/edit/{id}', [UserController::class, 'edit']);
Router::get('/users/show/{id}', [UserController::class, 'show']);
Router::get('/users/delete/{id}', [UserController::class, 'delete']);

Router::post('/users', [UserController::class, 'create']);
Router::put('/users/{id}', [UserController::class, 'update']);

Router::delete('/users/{id}', [UserController::class, 'delete']);
Router::get('/users/rest', [UserRestController::class, 'index']);

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