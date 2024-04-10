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
        $supmat1= new Materiel();
        if(isset($_POST['btn-del']))
        { 
           
        session_start();
        $id = $_POST['id'];
       
        $supmat1->delete($id);
        header('location:accueil.php');

        }
        
        
        
        
       


        
    ?>
