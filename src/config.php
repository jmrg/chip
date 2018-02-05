<?php

use \Symfony\Component\Yaml\Yaml;

if (!function_exists('setFileConfig')) {
    /**
     * It configures the location files.
     *
     * @param string $pathFile
     */
    function setFileConfig($pathFile)
    {
        if (!isset($GLOBALS['config'])) {
            $GLOBALS['config'] = Yaml::parse(file_get_contents($pathFile));
        }
    }
}

if (!function_exists('config')) {
    /**
     * Return the array with the configuration.
     *
     * @return array|null
     */
    function config()
    {
        return isset($GLOBALS['config'])
            ? $GLOBALS['config'] : null;
    }
}
