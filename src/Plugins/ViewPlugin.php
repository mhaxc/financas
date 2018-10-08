<?php
declare(strict_types=1);

namespace SONFin\Plugins;

use Interop\Container\ContainerInterface;
use SONFin\ServiceContainerInterface;
use SONFin\View\ViewRender;


class ViewPlugin implements PluginInterface
{
    /**
     * @param ServiceContainerInterface $container
     */
    public function register(ServiceContainerInterface $container)
    {
        $container->addLazy('twig',function(ContainerInterface $container){
            $loader = new \Twig_Loader_Filesystem(__DIR__.'/../../templates');
            $twig = new \Twig_Environment($loader);
          
                $generator=$container->get('routing.generator');
                $twig->addFunction(new \Twig_SimpleFunction('route',
                function (string $name,array $params=[]){
                        return $generator->generate($name,$params);
                }
            
        ));


            return $twig;
        });
            $container->addLazy('view.render',function(ContainerInterface $container){
                $twigEnvironment = $container->get ('twig');
                return new ViewRender($twigEnvironment);

        });


    }



}