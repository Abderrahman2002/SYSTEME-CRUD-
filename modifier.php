<?php
session_start(); // Démarrer la session pour accéder aux données des étudiants

// Vérifier si l'identifiant de l'étudiant est passé dans l'URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    // Vérifier si l'étudiant existe dans la session
    if(isset($_SESSION['etudiants'][$id])) {
        $etudiant = $_SESSION['etudiants'][$id];
        
        // Vérifier si le formulaire de modification a été soumis
        if(isset($_POST['modifier'])) {
            // Récupérer les nouvelles données du formulaire
            $nom = $_POST['nom'];
            $numero = $_POST['numero'];
            $nomFamille = $_POST['nom_famille'];
            $prenom = $_POST['prenom'];
            $moyenne = $_POST['moyenne'];
            $etat = $_POST['etat'];
            
            // Mettre à jour les informations de l'étudiant dans la session
            $_SESSION['etudiants'][$id] = [
                'id' => $id,
                'nom' => $nom,
                'numero' => $numero,
                'nomFamille' => $nomFamille,
                'prenom' => $prenom,
                'moyenne' => $moyenne,
                'etat' => $etat
            ];

            // Rediriger vers la page index.php avec un message de succès
            header("Location: index.php?success=modify");
            exit();
        }
        
        // Afficher le formulaire de modification avec les données de l'étudiant
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Modifier un étudiant</title>
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            <div class="container mt-5">
                <h2>Modifier un étudiant</h2>
                <!-- Formulaire pour modifier les informations de l'étudiant -->
                <form action="modifier.php?id=<?php echo $id; ?>" method="POST">
                    <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $etudiant['nom']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="numero">Numéro:</label>
                        <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $etudiant['numero']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nom_famille">Nom de famille:</label>
                        <input type="text" class="form-control" id="nom_famille" name="nom_famille" value="<?php echo $etudiant['nomFamille']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom:</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $etudiant['prenom']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="moyenne">Moyenne:</label>
                        <input type="number" step="0.01" class="form-control" id="moyenne" name="moyenne" value="<?php echo $etudiant['moyenne']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="etat">État:</label>
                        <select class="form-control" id="etat" name="etat" required>
                            <option value="En cours" <?php if($etudiant['etat'] == 'En cours') echo 'selected'; ?>>En cours</option>
                            <option value="Terminé" <?php if($etudiant['etat'] == 'Terminé') echo 'selected'; ?>>Terminé</option>
                        </select>
                    </div>
                    <button type="submit" name="modifier" class="btn btn-primary">Enregistrer</button>
                </form>
            </div>
        </body>
        </html>
        <?php
    } else {
        // Rediriger si l'identifiant de l'étudiant est invalide
        header("Location: index.php");
        exit();
    }
} else {
    // Rediriger si l'identifiant de l'étudiant n'est pas spécifié
    header("Location: index.php");
    exit();
}
?>
