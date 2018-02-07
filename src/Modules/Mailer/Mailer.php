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
     * Mailer constructor.
     */
    private function __construct()
    {
        // ...
    }

    /**
     * This create a new instance of PHPMailer and set it.
     */
    public static function create()
    {
        $mail = new PHPMailer();

        $mail->SMTPDebug = config()['mail']['debug'];
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = config()['mail']['encryption'];

        $mail->Host = config()['mail']['host'];
        $mail->Port = config()['mail']['port'];

        $mail->Username = config()['mail']['username'];
        $mail->Password = config()['mail']['password'];

        return $mail;
    }
}
