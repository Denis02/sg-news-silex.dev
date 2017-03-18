<?php
require_once '../vendor/autoload.php';

$app = new Silex\Application();
$app['debug']=true;

$app->get('/hello/{name}', function ($name) use ($app){
    return "Hello {$app->escape($name)}";
});

//$app->get('/', 'App\Controllers\HomeController::index');
//
//$app->get('/users/{id}', 'App\Controllers\HomeController::user')
//    ->value('id',0)
//    ->assert('id','\d+');

$app->mount("/", new \App\Providers\Home());

$app->run();

