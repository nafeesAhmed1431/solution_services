<?php

defined('BASEPATH') OR exit('No Direct Script Allowed');

use PHPMAILER\PHPMailer\PHPMailer;
use PHPMAILER\PHPMailer\Exception;

class PHPMailer_Lib
{
    public function __construct()
    {
        log_message('Debug','Php mailer class is loaded!');     
    }


    public function load()
    {
        require_once APPPATH. 'third_party/PHPMailer/src/Exception.php';
        require_once APPPATH. 'third_party/PHPMailer/src/PHPMailer.php';
        require_once APPPATH. 'third_party/PHPMailer/src/SMTP.php';
        return new PHPMailer;
    }
}
?>