<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Validation du DOCUMENT</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <?php
     include ('classDocMat.php'); 
        // include ('model/mat.php');
        if(isset($_GET['id'])){
           
        session_start();
        $id = $_GET['id'];
        $supmat1= new Materiel();
        $supmat1->delete($id);
        header('location:accueil.php');

        }
        
        
        
        
       


        
    ?>
