<?php

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;

class Router extends TestCase
{
    /**
     * @var Process
     */
    private static $process;

    public static function setUpBeforeClass()
    {
        self::$process = new Process("php -S localhost:8000 -t tests/Modules/Router/public");
        self::$process->start();

        usleep(100000);
    }

    public static function tearDownAfterClass()
    {
        self::$process->stop();
    }

    public function testRequestShouldResponse200WithActionCallableAsFunction()
    {
        $client = new Client(['http_errors' => false]);
        $response = $client->request("GET", "http://localhost:8000/testActionCallableAsFunction");
        $response->getHeader('content-type');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Text for testing in callable function!!', (string) $response->getBody());
    }

    public function testRequestShouldResponse200WithActionCallableAsString()
    {
        $client = new Client(['http_errors' => false]);
        $response = $client->request("GET", "http://localhost:8000/testActionCallableAsString");
        $response->getHeader('content-type');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Text for testing in callable string!!', (string) $response->getBody());
    }

    public function testRequestShouldResponse200WithActionCallableAsArray()
    {
        $client = new Client(['http_errors' => false]);
        $response = $client->request("GET", "http://localhost:8000/testActionCallableAsArray");
        $response->getHeader('content-type');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Text for testing in callable array!!', (string) $response->getBody());
    }
}
