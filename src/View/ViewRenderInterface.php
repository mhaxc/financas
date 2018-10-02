<?php
declare (strict_types=1);
namespace SONFin\View;

use Psr\Http\Message\ResponseInterface;

interface ViewRenderInterface
{
    /**
     * @param string $template
     * @param array $context
     * @return ResponseInterface
     */
    public function render(string $template,array $context =[]):ResponseInterface;

}