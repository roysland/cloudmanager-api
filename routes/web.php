<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/auth/code', 'AuthController@getCode');

$router->get('/user', 'UserController@me');
$router->get('/user/repos', 'UserController@repos');
// $router->get('/user', ['middleware' => 'auth', 'uses' => 'UserController@me']);
$router->get('/services', 'ServiceController@getServices');
$router->post('/service/create', 'ServiceController@store');

$router->get('/services/{service}', 'ServiceController@getService');