<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class SMTPServer
{
    public function sendEmail($receiverEmail, $receiverName, $message, $subject){

        //require needed files
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';
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