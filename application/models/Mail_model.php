<?php
/**
|--------------------------------------------------------------------------|
| Copyright Notice                                                         |
|--------------------------------------------------------------------------|
| TOLONG UNTUK TIDAK MENGUBAH-UBAH SCRIPT DALAM HALAMAN INI TANPA          |
| SEIZIN DARI PEMILIK SOURCE CODE. HARAGAILAH SETIAP PEKERJAAN YANG        |
| TELAH DILAKUKAN OLEH PEMBUAT APLIKASI INI. JIKA ANDA INGIN MENGUBAH      |
| SEBAGIAN ATAU SELURUH KODE YANG ADA DALAM SCRIPT DIBAWAH INI TOLONG      |
| HUBUNGI E-MAIL AUTHOR!!!.                                                |
|--------------------------------------------------------------------------|
 */
/**
 * @package sms_sekolah
 * @author alif firdi <aliffirdi07@gmail.com>
 * @copyright 2020
 * @link https://aliffirdi.me
 * @since 1.0.0 beta
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class mail_model extends CI_Model
{
    public function send($rcvMailAddr = null, $rcvMailName = null, $rcvMailSubj = null, $rcvMailBody = null)
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        //Enable SMTP debugging
        // SMTP::DEBUG_OFF = off (for production use)
        // SMTP::DEBUG_CLIENT = client messages
        // SMTP::DEBUG_SERVER = client and server messages
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host = $this->db->get_where('site_options', array('option_name' => 'mailserver_url'))->result_array()[0]['option_value'];
        $mail->Port = $this->db->get_where('site_options', array('option_name' => 'mailserver_port'))->result_array()[0]['option_value'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = $this->db->get_where('site_options', array('option_name' => 'mailserver_login'))->result_array()[0]['option_value'];
        $mail->Password = $this->db->get_where('site_options', array('option_name' => 'mailserver_pass'))->result_array()[0]['option_value'];
        $mail->setFrom($this->db->get_where('site_options', array('option_name' => 'mailserver_login'))->result_array()[0]['option_value'], $this->db->get_where('site_options', array('option_name' => 'app_name'))->result_array()[0]['option_value']);
        //$mail->addReplyTo('replyto@example.com', 'First Last');
        $mail->addAddress($rcvMailAddr, $rcvMailName);
        $mail->Subject = $rcvMailSubj;
        //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
        $mail->Body = $rcvMailBody;
        //$mail->AltBody = 'This is a plain-text message body';
        //$mail->addAttachment('images/phpmailer_mini.png');
        if (!$mail->send()) {
            $output = 'Mailer Error: '. $mail->ErrorInfo;
        } else {
            $output = true;
        }

        return $output;
    }
}