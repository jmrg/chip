<?php

$router->get('/testActionCallableAsFunction', function () {
    return 'Text for testing in callable function!!';
});

$router->get('/testActionCallableAsString', 'TestController@testOne');

$router->get('/testActionCallableAsArray', [new \Test\Controller\TestController, 'testDos']);
