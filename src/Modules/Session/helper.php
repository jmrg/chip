<?php

if (!function_exists('guest')) {
    /**
     * Return the guest from app.
     *
     * @return \Hoa\Session\Session
     */
    function guest()
    {
        return \Chip\Modules\Session\Session::guest();
    }
}
