<?php
namespace Chip\Modules\Model;

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Class Manager
 *
 * This allow to configure multiples connections with the
 * database, taking the parameters from config app.
 *
 * @package Chip\Modules\Model
 * @see https://github.com/illuminate/database#usage-instructions
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
     * This make a new connections with the db.
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

        $capsule->addConnection(config("databases.{$name}"));
        $capsule->setAsGlobal();

        return static::$capsules[$name] = $capsule;
    }
}
