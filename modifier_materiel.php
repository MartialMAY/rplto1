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
    // if(isset($_GET['id'])) {
    //     session_start();
    //     $id = $_GET['id'];
    //     $mat= new Materiel($_POST['Refe'], $_POST['Descrip'], $_POST['date_exp']);
        
    //     $mat->update($id);

    //     echo "Mise à jour effectuée avec succès.";
    //     header('location:dashboard.php');
    //     exit;
    // }
    // Vérifie si l'ID est défini dans la requête GET

    $mat= new Materiel();

    if(isset($_POST['btn-update']))
    {   session_start();
        $id = $_POST['id'];
        $Refe = $_POST['Refe'];
        $Descrip = $_POST['Descrip'];
        $date_exp = $_POST['date_exp'];
        
        
        if($mat->update($id,$Refe,$Descrip,$date_exp))
        {
            $msg = "<div class='alert alert-info'>
                    Modification avec success
                    </div>";
        }
        else
        {
            $msg = "<div class='alert alert-warning'>
                    Erreur de modification
                    </div>";
        }
    }
    header('location:accueil.php');
  
?>
