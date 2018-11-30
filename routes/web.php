<?php
use Illuminate\Support\Facades\Hash;

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

$router->group(['prefix' => 'api'], function($app) {
    $app->get('/login','UsersController@authenticate');
    $app->post('/todo','TodoController@store');
    $app->get('/todo', 'TodoController@index');
    $app->get('/todo/{id}', 'TodoController@show');
    $app->put('/todo/{id}', 'TodoController@update');
    $app->delete('/todo/{id}', 'TodoController@destroy');
});

$router->get('/index', 'UsersController@index');
$router->get('/about', 'UsersController@about');
$router->get('/products', 'UsersController@products');
$router->get('/store', 'UsersController@store');

$router->get('/admin/login', 'AdminController@login');
$router->post('/admin/signin', 'AdminController@signin');
$router->get('/admin/change-pass', 'AdminController@change');
$router->group(['middleware' => 'auth'], function($app) {
    $app->get('/admin/home', 'AdminController@home');
    $app->get('/admin/get-day-time', 'AdminController@getTime');
    $app->get('/admin/edit-day-time', 'AdminController@editTIme');
    $app->get('/admin/logout', 'AdminController@logout');
});
