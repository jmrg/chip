<?php
namespace Chip\Modules\Config;

use Symfony\Component\Yaml\Yaml;

/**
 * Class Config
 * @package Chip\Modules\Config
 */
class Config
{
    /**
     * @var array
     */
    private static $configurations;

    /**
     * @var static
     */
    private static $instance;

    /**
     * Config constructor.
     * @param string $path
     */
    private function __construct($path)
    {
        if (is_null(static::$instance)) {
            static::$configurations = Yaml::parse(file_get_contents($path));
            static::$instance = $this;
        }
    }

    /**
     * It configure an file from the location.
     *
     * @param string $path
     */
    public static function init($path)
    {
        new static($path);
    }

    /**
     * Return the configuration done as array.
     *
     * @return array
     */
    public static function get()
    {
        return static::$configurations;
    }
}
