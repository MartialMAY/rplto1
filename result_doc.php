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
        $doc1= new Document($_POST["Ref_doc"], $_POST["fichier"], $_POST["date_creation"], $_POST["date_exp"]);
        $doc1->create();


        $heure=date("H:i:s");  
          
        echo "Le document a bien été crée à ".$heure.".";

    ?>

