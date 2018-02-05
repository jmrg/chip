<?php

use PHPUnit\Framework\TestCase;
use \Chip\Modules\View\View as ViewComponent;

class View extends TestCase
{
    public function testShouldUpComponentViewAndRenderingView()
    {
        ViewComponent::config(
            __DIR__ . '/../Modules/View/resources',
            __DIR__ . '/../Modules/View/cache'
        );

        $render = view('hello-world', ['name' => 'World!!']);
        $content = "<h1>Hello, World!!</h1>";

        $this->assertEquals($content, $render);
    }
}
