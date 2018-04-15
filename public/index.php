<?php

use \Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\SapiEmitter;
use \Zend\Diactoros\ServerRequestFactory;
use Aura\Router\RouterContainer;

chdir(dirname(__DIR__));
require_once 'vendor/autoload.php';

## Initialization
$request = ServerRequestFactory::fromGlobals();
$aura = new RouterContainer();
$map = $aura->getMap();

$map->get('blog_show', '/blog/{id}', \App\Controller\BlogController::class)->tokens(['id' => '\d+']);

### Running

try {
    $matcher = $aura->getMatcher();
    $route = $matcher->match($request);
    
    
    
} catch (Exception $e) {

}

### Preprocessing

## Action
$name = $request->getQueryParams()['name'] ?? 'Guest';
$response = new HtmlResponse("Hello, {$name}!");

## Postprocessing
$response = $response->withHeader('X-Developer', 'Necrom');

## Sending
$emitter = new SapiEmitter();
$emitter->emit($response);