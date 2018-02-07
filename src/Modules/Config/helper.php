<?php

if (!function_exists('config')) {
    /**
     * Return the array with the configuration.
     *
     * @param string $key <Keys nested separated with points.>
     * @return array|null
     */
    function config($key = null)
    {
        return \Chip\Modules\Config\Config::get($key);
    }
}
