<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Validation du DOCUMENT</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <?php
        // include ('model/mat.php');
        include ('classDocMat.php');
        session_start();
        $doc1= new Materiel($_POST["Ref_mat"], $_POST["Description_mat"], $_POST["date_creation"], $_POST["date_exp"]);
        $doc1->create();


        $heure=date("H:i:s");  
          
        
        
        $_SESSION['alert_message'] = "Nouveau materiel ajouté avec succès";
        
        header("Location: accueil.php");
       
    ?>
