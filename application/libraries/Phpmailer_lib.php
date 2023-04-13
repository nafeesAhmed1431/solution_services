<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PHPMailer_Lib
{
    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->model('Commons_model');
    }

    public function load()
    {
        require_once APPPATH . 'third_party/PHPMailer/src/Exception.php';
        require_once APPPATH . 'third_party/PHPMailer/src/PHPMailer.php';
        require_once APPPATH . 'third_party/PHPMailer/src/SMTP.php';
        return new PHPMailer;
    }

    public function send_mail($to, $subject, $body, $attachment = null, $cc = null, $bcc = null)
    {
        $setting = $this->CI->Commons_model->get_row('tbl_mail_settings', ['active' => 1]);
        $mail = $this->load();
        $mail->isSMTP();
        $mail->Host = $setting->smtp_host;
        $mail->SMTPAuth = true;
        $mail->Username = $setting->smtp_user;
        $mail->Password = $setting->smtp_password;
        $mail->SMTPSecure = $setting->smtp_crypto;
        $mail->Port = $setting->smtp_port;
        $mail->isHTML(true);
        $mail->setFrom($setting->admin_email);
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        // Add CC recipients
        if (!empty($cc) && is_array($cc)) {
            foreach ($cc as $email) {
                $mail->addCC($email);
            }
        }

        // Add BCC recipients
        if (!empty($bcc) && is_array($bcc)) {
            foreach ($bcc as $email) {
                $mail->addBCC($email);
            }
        }

        // Add attachments
        if (!empty($attachment) && is_array($attachment)) {
            foreach ($attachment as $file) {
                $mail->addAttachment($file['path'], $file['name']);
            }
        }

        return $mail->send();
    }
}
