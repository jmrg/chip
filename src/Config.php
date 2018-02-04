<?php

use \Symfony\Component\Yaml\Yaml;

if (!function_exists('setFileConfig')) {
    function setFileConfig($pathFile)
    {
        if (!isset($GLOBALS['config'])) {
            $GLOBALS['config'] = Yaml::parse(file_get_contents($pathFile));
        }
    }
}

if (!function_exists('config')) {
    function config()
    {
        return isset($GLOBALS['config'])
            ? $GLOBALS['config'] : null;
    }
}
