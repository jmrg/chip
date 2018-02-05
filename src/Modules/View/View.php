<?php
namespace Chip\Modules\View;

use Philo\Blade\Blade;

class View
{
    /**
     * It keep the path to folder cache.
     *
     * @var Blade
     */
    private static $instance;

    /**
     * View constructor.
     *
     * @param string $pathViews
     * @param string $pathCache
     */
    private function __construct($pathViews, $pathCache)
    {
        if (is_null(static::$instance)) {
            static::$instance = new Blade($pathViews, $pathCache);
        }
    }

    /**
     * It up the configuration for the componente views.
     *
     * @param string $pathViews
     * @param string $pathCache
     */
    public static function config($pathViews, $pathCache)
    {
        new static($pathViews, $pathCache);
    }

    /**
     * Load a view from a path.
     *
     * @param string $path
     * @param array $data
     * @param array $mergeData
     * @return Illuminate\View\Factory
     */
    public static function make($path = null, $data = [], $mergeData = [])
    {
        if (!empty($path)) {
            return static::$instance->view()->make($path, $data, $mergeData)->render();
        }

        return static::$instance->view();
    }
}
