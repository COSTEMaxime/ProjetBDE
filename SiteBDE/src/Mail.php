<?php

namespace App;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
class Mail
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer();

        $this->mail->IsSMTP();
        $this->mail->SMTPDebug = 1;
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->Port = 587;
        $this->mail->IsHTML(true);

        $this->mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $this->mail->Username = 'coste.maxime2@gmail.com';
        $this->mail->Password = 'gMWCGFbxW53fYp';
    }

    public function sendMail($recipient, $data, $attachments = null)
    {
        try {

            $this->mail->setFrom('coste.maxime2@gmail.com');
            $this->mail->addAddress($recipient);

            //$mail->addBCC('bde@viacesi.fr');

            if(!is_null($attachments))
            {
                foreach($attachments as $attachment)
                {
                    $this->mail->addAttachment($attachment['path'], isset($attachment['name']) ? $attachment['name'] : null);
                }
            }

            $this->mail->isHTML(true);
            $this->mail->Subject = $data['subject'];
            $this->mail->Body    = $data['body'];

            $this->mail->send();

            echo 'Message has been sent';

        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $this->mail->ErrorInfo;
        }

    }


}