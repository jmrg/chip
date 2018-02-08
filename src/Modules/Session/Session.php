<?php
namespace Chip\Modules\Session;

use \Hoa\Session\Session as HoaSession;

/**
 * Class Session
 *
 * This allow configure a guest and manipulate it.
 *
 * @package Chip\Modules\Session
 * @see https://hoa-project.net/En/Literature/Hack/Session.html
 */
class Session
{
    /**
     * @var \Hoa\Session\Session
     */
    private static $guest;

    /**
     * Session constructor.
     *
     * @param $guest
     * @throws \Exception
     */
    private function __construct($guest)
    {
        if (is_null(static::$guest)) {
            static::$guest = new HoaSession($guest);
        } else {
            throw new \Exception('Already there is a guest config.');
        }
    }

    /**
     * Return a instance
     * @param string $guest
     * @return static
     */
    public static function of($guest)
    {
        return new static($guest);
    }

    /**
     * Return the guest from app.
     *
     * @return \Hoa\Session\Session
     */
    public static function guest()
    {
        return static::$guest;
    }
}
