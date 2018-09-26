<?php
require_once __DIR__ .'/../vendor/autoload.php';

use SONFin\Application;
use SONFin\Plugins\RoutePlugin;
use SONFin\ServiceContainer;

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new RoutePlugin());

$app->get('/',function(){
    echo 'hello word';
});

$app->start();