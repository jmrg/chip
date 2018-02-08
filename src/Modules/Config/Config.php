<?php
namespace Chip\Modules\Config;

use Symfony\Component\Yaml\Yaml;

/**
 * Class Config
 *
 * This class allow take the configurations from a file
 * with format YAML in a location specific and keep
 * it in a memory for later using.
 *
 * @package Chip\Modules\Config
 * @see https://symfony.com/doc/current/components/config.html
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
     *
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
     * Return the configuration prepared as array. This can
     * to receive a string with those keys of the array.
     *
     * @param string $key <Keys nested separated with points.>
     * @return array
     */
    public static function get($key = null)
    {
        if (!empty($key)) {
            $keys = explode(".", trim($key));

            $content = static::$configurations;
            foreach ($keys as $key) {
                $content = $content[trim($key)];
            }

            return $content;
        }

        return static::$configurations;
    }
}
