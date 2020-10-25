<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
    return [
        'version' => $router->app->version(),
        'routes' => $router->getRoutes(),
    ];
});

$router->post('/page', 'PagesController@create');

$router->get('/pages', 'PagesController@show');

$router->get('/page/{id}', 'PagesController@single');

$router->post('/page/{id}/popup', 'PopupsController@create');

$router->get('/page/{id}/popups', 'PopupsController@show');
