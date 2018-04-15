<?php

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

class BlogController
{
    public function __invoke(ServerRequestInterface $request)
    {
        return new HtmlResponse('Hello');
    }
    
    public function testAction()
    {
    
    }
}