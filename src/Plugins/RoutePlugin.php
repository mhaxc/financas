<?php
declare(strict_types=1);

namespace SONFin\Plugins;
use Aura\Router\RouterContainer;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use SONFin\ServiceContainerInterface;
use Zend\Diactoros\Server;
use Zend\Diactoros\ServerRequestFactory;
use SONFin\Plugins\PluginInterface;


class RoutePlugin implements PluginInterface
{
    public function register(ServiceContainerInterface $container)
    {
        //registar as  rotas da aplicaçao
        $routerContainer = new RouterContainer();
        $map = $routerContainer->getMap();
        /*tem a funçao de  indentificar a rota que  vai ser acessada  */
        $matcher=$routerContainer->getMatcher();
        //tem a  funçao de  gerar  link
        $generator=$routerContainer->getGenerator();
        $request = $this->getRequest();

        $container->add('routing',$map);
        $container->add('routing.matcher',$matcher);
        $container->add('routing.generator',$generator);
        $container->add(RequestInterface::class,$request);

        $container->addLazy('route',function(ContainerInterface $container){
            $matcher = $container->get('routing.matcher');
            $request = $container->get(RequestInterface::class);
             return $matcher->match($request);
        });
    }

    protected function getRequest():RequestInterface
    { ServerRequestFactory::fromGlobals(
        $_SERVER,$_GET,$_POST,$_COOKIE,$_FILES
    );


    }

}