<?php

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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->post('/test', 'adminController@test');

$router->post('/register', 'adminController@register');
$router->post('/login', 'adminController@login');

$router->post('/uploadCV', 'adminController@uploadCV');
$router->post('/skillCategory', 'adminController@skillCategory');

$router->post('/soal', 'adminController@soal');
$router->post('/submitExam', 'adminController@submit');

$router->post('/seen', 'adminController@seen');
$router->post('/hired', 'adminController@hired');

$router->post('/pdf', 'adminController@downloadPDF');