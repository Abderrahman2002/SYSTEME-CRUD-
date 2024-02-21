<?php
session_start();

// Vérifier si des données ont été soumises
if(isset($_POST['modifier'])) {
    // Récupérer les nouvelles données du formulaire
    $nom = $_POST['nom'];
    $numero = $_POST['numero'];
    $nomFamille = $_POST['nom_famille'];
    $prenom = $_POST['prenom'];
    $moyenne = $_POST['moyenne'];
    $etat = $_POST['etat'];

    // Afficher les données modifiées par l'utilisateur
    echo "<h2>Données modifiées de l'étudiant :</h2>";
    echo "<p>Nom : $nom</p>";
    echo "<p>Numéro : $numero</p>";
    echo "<p>Nom de famille : $nomFamille</p>";
    echo "<p>Prénom : $prenom</p>";
    echo "<p>Moyenne : $moyenne</p>";
    echo "<p>État : $etat</p>";

    // Redirection vers index.php après quelques secondes
    header("refresh:3;url=index.php");
    exit();
} else {
    // Redirection vers index.php si aucune donnée n'a été soumise
    header("Location: index.php");
    exit();
}
?>
