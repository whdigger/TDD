<?php

namespace Tests\Framework\Http;

use PHPUnit\Framework\TestCase;
use Zend\Diactoros\Response\HtmlResponse;

class RequestTest extends TestCase
{
    public function testEmpty(): void
    {
        $response = new HtmlResponse($body = 'Body');
        
        $this->assertEquals($body, $response->getBody()->getContents());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('OK', $response->getReasonPhrase());
    }
}