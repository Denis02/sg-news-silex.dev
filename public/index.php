<?php
require_once '../vendor/autoload.php';

session_start();
date_default_timezone_set('europe/kiev');

// Константы проекта
define('ROOT_DIR',getcwd().'/../');
define('APP_DIR',getcwd().'/../app/');


$app = new Silex\Application();
$app['debug']=true;


// app/providers.php
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../app/views',
));


$app->get('/', 'App\Controllers\HomeController::index');
$app->get('/login', 'App\Controllers\HomeController::getLogin');
$app->post('/login', 'App\Controllers\HomeController::postLogin');
$app->get('/logout', 'App\Controllers\HomeController::getLogout');

$app->mount("/", new App\Providers\Cabinet());

$app->run();

//$app->get('/users/{id}', 'App\Controllers\HomeController::user')
//    ->value('id',0)
//    ->assert('id','\d+');





