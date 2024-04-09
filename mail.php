<?php

        //Envoyer un mail avec PHPMailer
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        use PHPMailer\PHPMailer\SMTP;
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmx.com';
        $mail->SMTPAuth = true;
        $mail->SMTPDebug = 1;
        $mail->Username = 'palarouteetienne@gmx.com';
        $mail->Password = 'palarouteetienne1';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $address = "palarouteetienne@gmx.com";
        $mail->AddAddress($address, "John Doe");
        $mail->setFrom('palarouteetienne@gmx.com', 'First Last');
        $mail->addReplyTo('palarouteetienne@gmx.com', 'John Doe');
        $mail->isHTML(true);
        $mail->Subject = "PHPMailer SMTP test";
        $mail->Body = 'Message for me !';
        $mail->AltBody = 'This is the plain text version of the email content';
        if(!$mail->send()){
            $myfile = fopen("f1.txt", "w") or die("Unable to open file!");
            $txt = 'Mailer Error: ' . $mail->ErrorInfo;
            fwrite($myfile, $txt);
            fclose($myfile);
        }else{
            $myfile = fopen("f2.txt", "w") or die("Unable to open file!");
            $txt = 'Envoyé OK !';
            fwrite($myfile, $txt);
            fclose($myfile);
        }
      
        ?> 