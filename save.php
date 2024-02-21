<?php
session_start(); // Démarrer la session pour accéder aux données des étudiants

// Vérifier si les données de l'étudiant sont présentes dans la session
if(isset($_SESSION['nouvel_etudiant'])) {
    $nouvelEtudiant = $_SESSION['nouvel_etudiant'];
    
    // Vérifier si le formulaire de sauvegarde a été soumis
    if(isset($_POST['confirm'])) {
        // Ajouter le nouvel étudiant à la session des étudiants existants
        $_SESSION['etudiants'][] = $nouvelEtudiant;
        
        // Rediriger vers la page index.php avec un message de succès
        header("Location: index.php?success=save");
        exit();
    }
    
    // Afficher les informations de l'étudiant à confirmer
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Confirmation d'enregistrement</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5">
            <h3>Confirmez-vous les informations suivantes :</h3>
            <ul>
                <li><strong>Nom :</strong> <?php echo $nouvelEtudiant['nom']; ?></li>
                <li><strong>Numéro :</strong> <?php echo $nouvelEtudiant['numero']; ?></li>
                <li><strong>Nom de famille :</strong> <?php echo $nouvelEtudiant['nomFamille']; ?></li>
                <li><strong>Prénom :</strong> <?php echo $nouvelEtudiant['prenom']; ?></li>
                <li><strong>Moyenne :</strong> <?php echo $nouvelEtudiant['moyenne']; ?></li>
                <li><strong>État :</strong> <?php echo $nouvelEtudiant['etat']; ?></li>
            </ul>
            <form method="post">
                <button type="submit" name="confirm" class="btn btn-success mr-2">Confirmer</button>
                <a href="ajouter.php" class="btn btn-secondary">Modifier</a>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit();
}

// Rediriger vers la page index.php si les données de l'étudiant ne sont pas présentes dans la session
exit();
?>
