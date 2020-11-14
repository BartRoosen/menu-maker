<?php


namespace Services;


use PHPMailer\PHPMailer\PHPMailer;

class MailService
{

    /** @var PHPMailer */
    private PHPMailer $phpMailer;
    /**
     * MailService constructor.
     */
    public function __construct()
    {
        $this->phpMailer = new PHPMailer(true);
    }

    public function sendEmail()
    {

    }
}