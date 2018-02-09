<?php
    namespace Chip\Modules\Mailer;

use PHPMailer\PHPMailer\PHPMailer;

/**
 * Class Mailer
 *
 * This class encapsulates the utilization of PHPMailer and
 * allow set it returning an instance of this library
 * already to use.
 *
 * The parameters to set are taken from the configuration
 * file through config method.
 *
 * @package Chip\Modules\Mailer
 * @see https://github.com/PHPMailer/PHPMailer
 */
class Mailer
{
    /**
     * This keep an instance for the library mail.
     *
     * @var PHPMailer
     */
    private $instance;

    /**
     * Mailer constructor.
     */
    private function __construct()
    {
        $this->instance = new PHPMailer();
    }

    /**
     * This create a new instance of PHPMailer and set it.
     *
     * @return PHPMailer
     */
    public static function create()
    {
        return (new static())
            ->config()
            ->getInstance();
    }

    /**
     * This configure the instance when that was created.
     * 
     * @return static
     */
    private function config()
    {
        # Driver parameters...
        $this->getInstance()->SMTPDebug = config('mail.debug');
        $this->getInstance()->isSMTP();
        $this->getInstance()->SMTPAuth = true;
        $this->getInstance()->SMTPSecure = config('mail.encryption');

        # Parameters server...
        $this->getInstance()->Host = config('mail.host');
        $this->getInstance()->Port = config('mail.port');

        # Credentials...
        $this->getInstance()->Username = config('mail.username');
        $this->getInstance()->Password = config('mail.password');

        return $this;
    }

    /**
     * Return the instance created for the library mail.
     *
     * @return PHPMailer
     */
    private function getInstance()
    {
        return $this->instance;
    }
}
