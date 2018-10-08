<?php
require_once __DIR__ .'/../vendor/autoload.php';

use Psr\Http\Message\RequestInterface;
use SONFin\Application;
use Psr\Http\Message\ServerRequestInterface;
use SONFin\Plugins\RoutePlugin;
use SONFin\Plugins\ViewPlugin;
use SONFin\Plugins\DbPlugin;
use SONFin\ServiceContainer;
use SONFin\ServiceContainerInterface;
use SONFin\Models\CategoryCost;

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new RoutePlugin());
$app->plugin(new ViewPlugin());
$app->plugin(new DbPlugin());

//router

$app->get('/',function(RequestInterface $request)use ($app){
$view =$app->service('view.render');
    return $view->render('test.html.twig');

});

$app->get('/home/{name}',function (ServerRequestInterface $request){
$response=new \Zend\Diactoros\Response();
    $response->getBody()->write("response com emitter do diastor");
   return $response;
});


$app
->get('/category-costs',function ()use ($app){
  $view = $app->service('view.render');
    $meuModel = new \SONFin\Models\CategoryCost();
    $categories = $meuModel->all();
    return $view->render('category-costs/list.html.twig',[
        'categories'=>$categories
    ],'category-costs.list');
})


->get('/category-costs/new',function ()use ($app){
    $view = $app->service('view.render');

      return $view->render('category-costs/create.html.twig');     
  },'category-costs.new')
 
 
  ->post('/category-costs/store',function (ServiceContainerInterface $request)use ($app){
        $data =$request->getParsedBody();
        \SONFin\Models\CategoryCost::create($data);
        return $app->route('/category-costs.list');
  },'category-costs.store');

$app->start();