<?php
// inclusion de la classe GestionEquipements
require_once('classDocMat.php');
include_once('conn/connection.php');

// Vérification du formulaire d'ajout de document
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reference = $_POST['reference'];
    $description = $_POST['description'];
    $dateCreation = $_POST['date_creation'];
    $dateExpiration = $_POST['date_expiration'];

    // Instanciation de la classe GestionEquipements
    $classDocMat = new classDocMat();

    // Appel de la méthode d'ajout de document
    $classDocMat->ajouterDocument($reference, $description, $dateCreation, $dateExpiration);

    // Redirection vers la page de confirmation
    header('Location: confirmation.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un document</title>
</head>
<body>
    <h1>Ajouter un document</h1>
    <form method="post" action="">
        <label>Référence :</label>
        <input type="text" name="reference" required><br>
        <label>F :</label>
        <textarea name="description" required></textarea><br>
        <label>Date de création :</label>
        <input type="datetime-local" name="date_creation" required><br>
        <label>Date d'expiration :</label>
        <input type="datetime-local" name="date_expiration" required><br>
        <input type="submit" value="Ajouter">
    </form>
</body>
</html>
