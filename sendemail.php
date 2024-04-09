<?php
use PHPMailer\PHPMailer\PHPMailer;

require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';
include_once('conn/connection.php');
$mail = new PHPMailer(true);

$alert = '';
$stmt = $conn->prepare("
    SELECT d.Reference AS reference_document, m.Refe AS reference_materiel, d.Date_Exp AS date_expiration_document, m.date_exp AS date_expiration_materiel, u.email
    FROM document AS d
    LEFT JOIN materiel AS m ON d.Reference = m.Refe
    LEFT JOIN utilisateurs AS u ON d.utilisateur_id = u.ID
    WHERE d.Date_Exp BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 1 MINUTE)
    OR m.date_exp BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 1 MINUTE)
");
$stmt->execute();
$elements = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($elements as $element) {
try{
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'lauthentiquemay@gmail.com'; 
    $mail->Password = 'jqvo omta fbtu nrql'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = '587';

    $mail->setFrom('lauthentiquemay@gmail.com'); 
    $mail->addAddress('lauthentiquemay@gmail.com'); 

    $mail->isHTML(true);
    if (!empty($element['reference_document'])) {
    
    $mail->Subject = 'rappel  ';
    $mail->Body = "<h3> vous ajouté un nouveau document ou materiel </h3>";

    $mail->send();
    $alert = '<div id="alert" class="alert-success">
    <span>Message envoyé ! Merci de nous avoir contactés.</span>
    <button class="close-btn" onclick="closeAlert()">&times;</button></div>';
    echo '<script>window.location.href = "#contact";</script>'; 
    }

    if (!empty($element['reference_materiel'])) {
    
    $mail->Subject = 'rappel  ';
    $mail->Body = "<h3> vous ajouté un nouveau document ou materiel </h3>";

    $mail->send();
    $alert = '<div id="alert" class="alert-success">
    <span>Message envoyé ! Merci de nous avoir contactés.</span>
    <button class="close-btn" onclick="closeAlert()">&times;</button></div>';
    echo '<script>window.location.href = "#contact";</script>'; 
    
} 
catch (Exception $e){
$alert = '<div class="alert-error">
   <span>'.$e->getMessage().'</span>
   <button class="close-btn" onclick="closeAlert()">&times;</button></div>';
}
}
}
?>

<script type="text/javascript">
    // Fonction pour masquer l'alerte avec une animation douce
    function closeAlert() {
        var alert = document.getElementById('alert');
        if (alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = 0;
            setTimeout(function() {
                alert.style.display = 'none';
            }, 500); // Attendre la fin de l'animation avant de masquer complètement l'alerte
        }
    }

    // Masquer l'alerte après 3 secondes
    setTimeout(function() {
        closeAlert();
    }, 5000);
</script>

<style>
    .close-btn {
        background-color: transparent;
        border: none;
        color: #000;
        cursor: pointer;
        font-size: 24px; /* Augmenter la taille du bouton */
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
    }

    .close-btn:hover {
        color: #FF0000;
    }
</style>
