<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once '../vendor/autoload.php';

//session_start();
date_default_timezone_set('europe/kiev');

// Константы проекта
define('ROOT_DIR',getcwd().'/../');
define('APP_DIR',getcwd().'/../app/');


$app = new Silex\Application();
$app['debug']=true;

Request::enableHttpMethodParameterOverride();


// app/providers.php
//$app->register(new Silex\Provider\TwigServiceProvider(), array(
//    'twig.path' => __DIR__ . '/../app/views',
//));
$app->register(new Silex\Provider\SessionServiceProvider());

$app->error(function (\Exception $e, Request $request, $code){
    switch ($code){
        case 404:
            $message = 'Сторінка не знайдена!'; break;
        default:
            $message = 'Сталася помилка!'.$e;
    }
    return new Response($message);
});

$app->get('/', 'App\Controllers\HomeController::index');
$app->get('/login', 'App\Controllers\HomeController::getLogin');
$app->post('/login', 'App\Controllers\HomeController::postLogin');
$app->get('/logout', 'App\Controllers\HomeController::getLogout');

$app->mount("/cabinet", new App\Providers\Cabinet())
    ->before('App\Controllers\CabinetController::_before');
$app->run();
