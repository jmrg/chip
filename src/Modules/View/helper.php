<?php

if (!function_exists('view')) {
    /**
     * It render a view from a path location.
     *
     * @param string $path
     * @param array $data
     * @param array $mergeData
     * @return \Chip\Modules\View\Illuminate\View\Factory
     */
    function view($path = null, $data = [], $mergeData = [])
    {
        return Chip\Modules\View\View::make($path, $data, $mergeData);
    }
}
