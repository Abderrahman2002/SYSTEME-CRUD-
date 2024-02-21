<?php
session_start(); // Démarrer la session pour accéder aux données des étudiants

function calculerMoyenneTotale($etudiants) {
    $totalMoyenne = 0;
    $nombreEtudiants = count($etudiants);
    
    // Parcourir tous les étudiants et ajouter leur moyenne au total
    foreach($etudiants as $etudiant) {
        $totalMoyenne += $etudiant['moyenne'];
    }
    
    // Calculer la moyenne totale
    if($nombreEtudiants > 0) {
        return $totalMoyenne / $nombreEtudiants;
    } else {
        return 0;
    }
}

// Vérifier si la session 'etudiants' est définie et n'est pas vide
if(isset($_SESSION['etudiants']) && !empty($_SESSION['etudiants'])) {
    // Calculer la moyenne totale
    $moyenneTotale = calculerMoyenneTotale($_SESSION['etudiants']);
} else {
    // Si aucun étudiant n'est présent dans la session, initialiser la moyenne totale à 0
    $moyenneTotale = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Inclure Font Awesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Liste des étudiants</h2>
        <?php
        // Vérifier si un message de succès est présent dans l'URL
        if(isset($_GET['success']) && $_GET['success'] == 'true') {
            echo '<div class="alert alert-success" role="alert">Étudiant ajouté avec succès!</div>';
        }

        if(isset($_GET['success']) && $_GET['success'] == 'delete' && isset($_GET['nom'])) {
            $nomEtudiantSupprime = $_GET['nom'];
            // Afficher un message de succès avec le nom de l'étudiant supprimé
            echo '<div class="alert alert-success" role="alert">L\'étudiant '.htmlspecialchars($nomEtudiantSupprime).' a été supprimé avec succès!</div>';
        }
        ?>
        <!-- Tableau pour afficher les étudiants -->
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Numéro</th>
                    <th>Nom de famille</th>
                    <th>Prénom</th>
                    <th>Moyenne</th>
                    <th>État</th>
                    <th>Action</th> <!-- Nouvelle colonne pour les actions -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Vérifier si des étudiants sont présents dans la session
                if(isset($_SESSION['etudiants']) && !empty($_SESSION['etudiants'])) {
                    // Parcourir les étudiants et les afficher dans le tableau
                    foreach($_SESSION['etudiants'] as $id => $etudiant) {
                        // Utiliser $id comme identifiant unique
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($etudiant['nom']) . '</td>';
                        echo '<td>' . htmlspecialchars($etudiant['numero']) . '</td>';
                        echo '<td>' . htmlspecialchars($etudiant['nomFamille']) . '</td>';
                        echo '<td>' . htmlspecialchars($etudiant['prenom']) . '</td>';
                        echo '<td>' . htmlspecialchars($etudiant['moyenne']) . '</td>';
                        echo '<td>' . htmlspecialchars($etudiant['etat']) . '</td>';
                        echo '<td>
                                <a href="modifier.php?id=' . $id . '" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="supprimer.php?id=' . $id . '" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                            </td>';
                        echo '</tr>';
                    }
                    
                } else {
                    // Si aucun étudiant n'est présent dans la session
                    echo '<tr><td colspan="7">Aucun étudiant ajouté pour le moment.</td></tr>';
                }
                ?>
            </tbody>
        </table>
          <!-- Bouton pour ajouter un nouvel étudiant -->
    <a href="ajouter.php" class="btn btn-primary">Ajouter un nouvel étudiant</a>&nbsp;   &nbsp; &nbsp; &nbsp; &nbsp;  Moyenne totale des étudiants : <?php echo $moyenneTotale; ?></div>
    
</body>
</html>
