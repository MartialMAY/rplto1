<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';



$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com'; 
$mail->SMTPAuth = true;
$mail->Username = 'lauthentiquemay@gmail.com'; 
$mail->Password = 'jqvo omta fbtu nrql'; 
$mail->SMTPSecure = "tls";
$mail->Port = "587";
$mail->setFrom('lauthentiquemay@gmail.com', 'Votre nom');
$mail->addAddress('lauthentiquemay@gmail.com', 'Destinataire');



   
    $documentQuery = $conn->query("SELECT * FROM Document WHERE Date_Exp <= DATE_ADD(NOW(), INTERVAL 1 DAY)");
    $documentQuery->execute();
    $documents = $documentQuery->fetchAll();

  
    $materielQuery = $conn->query("SELECT * FROM Materiel WHERE date_exp <= DATE_ADD(NOW(), INTERVAL 1 DAY)");
    $materielQuery->execute();
    $materiels = $materielQuery->fetchAll();

  
    foreach ($documents as $document) {
        $mail->Subject = 'Rappel de date d\'expiration';
        $mail->Body = 'La date d\'expiration du document ' . $document['Reference'] . ' est proche ou dépassée. ';
        if (!$mail->send()) {
            echo 'Erreur lors de l\'envoi du message : ' . $mail->ErrorInfo;
        } else {
           
                $_SESSION['document'] .= $mail->Body . '' . date('H:i:s') . '.'; // Concaténation du contenu dans la variable de session si le message n'existe pas déjà
            
        }
    }

    
    foreach ($materiels as $materiel) {
        $mail->Subject = 'Rappel de date d\'expiration';
        $mail->Body = 'La date d\'expiration du matériel ' . $materiel['Refe'] . ' est proche ou dépassée.' ;
        if (!$mail->send()) {
            echo 'Erreur lors de l\'envoi du message : ' . $mail->ErrorInfo;
        } else {
            
                $_SESSION['matériel'] .= $mail->Body . ''. date('H:i:s') . '.'; // Concaténation du contenu dans la variable de session si le message n'existe pas déjà
            
        }
    }



?>

