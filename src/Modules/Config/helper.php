<?php

if (!function_exists('config')) {
    /**
     * Return the array with the configuration.
     *
     * @return array|null
     */
    function config()
    {
        return \Chip\Modules\Config\Config::get();
    }
}
