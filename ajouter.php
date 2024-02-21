<?php
session_start(); // Démarrer la session pour accéder aux données des étudiants

// Vérifier si le formulaire d'ajout a été soumis
if(isset($_POST['sauvegarder'])) {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $numero = $_POST['numero'];
    $nomFamille = $_POST['nom_famille'];
    $prenom = $_POST['prenom'];
    $moyenne = $_POST['moyenne'];
    $etat = $_POST['etat'];

    // Ajouter l'étudiant dans la session avec un identifiant unique
    $id = uniqid();
    $_SESSION['etudiants'][$id] = [
        'id' => $id,
        'nom' => $nom,
        'numero' => $numero,
        'nomFamille' => $nomFamille,
        'prenom' => $prenom,
        'moyenne' => $moyenne,
        'etat' => $etat
    ];

    // Connexion à la base de données
    $mysqli = new mysqli("localhost", "utilisateur1", "motdepasse123", "gestion_etudiants");

    // Vérifier la connexion
    if ($mysqli->connect_error) {
        die("La connexion à la base de données a échoué: " . $mysqli->connect_error);
    }

    // Préparer la requête SQL d'insertion
    $sql = "INSERT INTO etudiants (nom, numero, nomFamille, prenom, moyenne, etat) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    // Liage des paramètres
    $stmt->bind_param("ssssds", $nom, $numero, $nomFamille, $prenom, $moyenne, $etat);

    // Exécution de la requête
    if ($stmt->execute()) {
        echo "Les données de l'étudiant ont été enregistrées avec succès.";
    } else {
        echo "Erreur lors de l'enregistrement des données de l'étudiant: " . $stmt->error;
    }

    // Fermeture de la requête et de la connexion
    $stmt->close();
    $mysqli->close();

    // Rediriger vers la page index.php avec un message de succès
    header("Location: index.php?success=true");
    exit(); // Arrêter l'exécution du script après la redirection
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un étudiant</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Ajouter un étudiant</h2>
        <!-- Formulaire pour ajouter un nouvel étudiant -->
        <form action="ajouter.php" method="POST">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="numero">Numéro:</label>
                <input type="text" class="form-control" id="numero" name="numero" required>
            </div>
            <div class="form-group">
                <label for="nom_famille">Nom de famille:</label>
                <input type="text" class="form-control" id="nom_famille" name="nom_famille" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="moyenne">Moyenne:</label>
                <input type="number" step="0.01" class="form-control" id="moyenne" name="moyenne" required>
            </div>
            <div class="form-group">
                <label for="etat">État:</label>
                <select class="form-control" id="etat" name="etat" required>
                    <option value="En cours">En cours</option>
                    <option value="Terminé">Terminé</option>
                </select>
            </div>
            <button type="submit" name="sauvegarder" class="btn btn-primary">Sauvegarder</button>
        </form>
    </div>
</body>
</html>
