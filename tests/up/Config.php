<?php

use PHPUnit\Framework\TestCase;
use Chip\Modules\Config\Config as ConfigModule;

class Config extends TestCase
{
    public function testShouldRaiseConfigurationFromFileAndReturnItsContent()
    {
        ConfigModule::init(__DIR__ . '/../Modules/Config/environment.yaml');

        $expected = [
            'Section1' => [
                'ItemA' => 'item-a',
                'ItemB' => 'item-b',
            ],
            'Section2' => [
                'ItemC' => 'item-c',
                'ItemD' => 'item-d',
            ],
        ];

        $this->assertEquals($expected, config());
    }
}
