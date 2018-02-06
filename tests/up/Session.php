<?php

use PHPUnit\Framework\TestCase;
use \Chip\Modules\Session\Session as SessionModule;

class Session extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testShouldCreateANewGuestAndReturnTheObject()
    {
        SessionModule::of('Guest');

        $this->assertInstanceOf(Hoa\Session\Session::class, guest());
        $this->assertTrue(guest()->isEmpty());
    }
}
