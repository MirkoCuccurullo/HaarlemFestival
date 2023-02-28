<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

use PHPMailer\PHPMailer\PHPMailer;

class SMTPServer
{
    public function sendEmail($receiverEmail, $receiverName, $message, $subject){


        require __DIR__ . '/../../vendor/PHPMailer/PHPMailer/src/Exception.php';
        require __DIR__ . '/../../vendor/PHPMailer/PHPMailer/src/PHPMailer.php';
        require __DIR__ . '/../../vendor/PHPMailer/PHPMailer/src/SMTP.php';
        require '../config.php';

        //initialize client
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Mailer = "smtp";

        //setup credentials
        $mail->SMTPDebug  = 1;
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = $smtpPort;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = $smtpEmail;
        $mail->Password   = $smtpPassword;


        //set receiver and message
        $mail->IsHTML(true);
        $mail->AddAddress($receiverEmail, $receiverName);
        $mail->SetFrom($smtpEmail, "Haarlem Festival");
        $mail->Subject = $subject;
        $content = "<b>$message</b>";

        $mail->MsgHTML($content);

        //send email
        try {
            $mail->send();
        }catch (Exception $e){
            echo $e->getMessage();
        }

    }

}