<?php
/**
 * Created by PhpStorm.
 * User: maxwelsilva
 * Date: 02/10/2018
 * Time: 14:33
 */

namespace SONFin\View;


use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;

class ViewRender implements ViewRenderInterface
{
    private $twigEnvironment;


    /**
     * ViewRender constructor.
     * @param \Twig_Environment $twigEnvironment
     */
    public function __construct(\Twig_Environment $twigEnvironment)
    {


        $this->twigEnvironment = $twigEnvironment;
    }

    /**
     * @param string $template
     * @param array $context
     * @return ResponseInterface
     */
    public function render(string $template,array $context=[]):ResponseInterface
 {

    $result = $this->twigEnvironment->render($template,$context);
     $response = new Response();
     $response->getBody()->write($result);
     return $response;
 }
}
