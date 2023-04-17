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

    public function send_mail2(
		$to,
		$subject,
		$body,
		$from = NULL,
		$from_name = NULL,
		$attachment = NULL,
		$cc = [],
		$bcc = []
	) {
		$set = $this->CI->Commons_model->get_row('tbl_mail_settings', ['active' => 1]);
		$mail = $this->load();
		$mail->CharSet = 'UTF-8';
		if ($set->protocol == 'smtp') {
			$mail->isSMTP();
			$mail->Host = $set->smtp_host;
			$mail->SMTPAuth = true;
			$mail->Username = $set->smtp_user;
			$mail->Password = $set->smtp_password;
			$mail->SMTPSecure = $set->smtp_crypto ?? false;
			$mail->Port = $set->smtp_port;
		} else {
			$mail->isMail();
		}
		$from = $from ?? $set->default_email;
		$from_name = $from_name ?? $set->site_name;
		$mail->setFrom($from, $from_name);
		$mail->addReplyTo($from, $from_name);
		$mail->addAddress($to);

		foreach ($cc as $email) {
			$mail->addCC($email);
		}
		foreach ($bcc as $email) {
			$mail->addBCC($email);
		}

		$mail->Subject = $subject;
		$mail->isHTML(true);
		$mail->Body = $body;
		if ($attachment) {
			if (is_array($attachment)) {
				foreach ($attachment as $attach) {
					$mail->addAttachment($attach);
				}
			} else {
				$mail->addAttachment($attachment);
			}
		}

		return $mail->send();
	}
}
