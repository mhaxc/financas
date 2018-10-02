<?php
require_once __DIR__ .'/../vendor/autoload.php';

use Psr\Http\Message\RequestInterface;
use SONFin\Application;
use Psr\Http\Message\ServerRequestInterface;
use SONFin\Plugins\RoutePlugin;
use SONFin\Plugins\ViewPlugin;
use SONFin\ServiceContainer;

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new RoutePlugin());
$app->plugin(new ViewPlugin());

//router

$app->get('/',function(RequestInterface $request){



    var_dump($request->getUri());die();
    echo 'hello word';
});

$app->get('/home/{name}',function (ServerRequestInterface $request){
$response=new \Zend\Diactoros\Response();
    $response->getBody()->write("response com emitter do diastor");
    return $response;

});

$app->start();