<?php
namespace Chip\Modules\Model;

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Class Manager
 * @package Chip\Modules\Model
 */
class Manager
{
    /**
     * Keep connections with multiples db.
     *
     * @var array
     */
    private static $capsules = [];

    /**
     * Make a new connections with the db.
     *
     * @param string $name
     * @return Capsule
     */
    public static function db($name)
    {
        if (isset(static::$capsules[$name])) {
            return static::$capsules[$name];
        }

        $capsule = new Capsule();

        $capsule->addConnection(config()['databases'][$name]);
        $capsule->setAsGlobal();

        return static::$capsules[$name] = $capsule;
    }
}
