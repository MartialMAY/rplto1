<?php
session_start();
include_once('conn/connection.php');
//error_reporting(0);
if (isset($_POST['login'])) {
    $username = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $query = "SELECT user_email, user_password FROM users WHERE user_email = :username AND user_password = :user_password";
    $stmt = $conn->prepare($query);

    // Liaison des paramètres
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':user_password', $user_password);

    // Exécution de la requête
    $stmt->execute();

    // Récupération des résultats
    $stmt->fetch();
    $count = $stmt->rowCount(); 
    // Utilisation de rowCount sur l'objet de requête préparée
    if ($count > 0) {
        
        $_SESSION['user_email'] = $username;
        header('location:accueil.php');
       
    } else {
        $_SESSION['invalid_details'] = "Combinaison NOM D'UTILISATEUR/MOT DE PASSE INVALIDE !";
        header('location:index.php');
    }

  
}
?>


