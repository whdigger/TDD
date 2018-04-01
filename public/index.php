<?php

use \Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\SapiEmitter;
use \Zend\Diactoros\ServerRequestFactory;

chdir(dirname(__DIR__));
require_once 'vendor/autoload.php';

$request = ServerRequestFactory::fromGlobals();

## Action
$name = $request->getQueryParams()['name']?? 'Guest';
$response = (new HtmlResponse("Hello, {$name}!"))->withHeader('X-Developer', 'Necrom');

## Sending
$emitter = new SapiEmitter();
$emitter->emit($response);