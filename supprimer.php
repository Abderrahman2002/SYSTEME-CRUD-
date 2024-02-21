<?php
session_start(); // Démarrer la session pour accéder aux données des étudiants

// Vérifier si l'identifiant de l'étudiant à supprimer est passé dans l'URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    // Vérifier si l'étudiant existe dans la session
    if(isset($_SESSION['etudiants'][$id])) {
        // Récupérer le nom de l'étudiant avant de le supprimer
        $nomEtudiant = $_SESSION['etudiants'][$id]['nom'];

        // Vérifier si la suppression a été confirmée
        if(isset($_POST['confirm'])) {
            // Supprimer l'étudiant de la session
            unset($_SESSION['etudiants'][$id]);
            
            // Rediriger vers la page index.php avec un message de succès contenant le nom de l'étudiant supprimé
            header("Location: index.php?success=delete&nom=".urlencode($nomEtudiant));
            exit();
        }
        
        // Afficher un message de confirmation de suppression stylisé avec Bootstrap
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Confirmation de suppression</title>
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            <div class="container mt-5">
                <h3>Voulez-vous vraiment supprimer l'étudiant <?php echo $nomEtudiant; ?> ?</h3>
                <form method="post">
                    <button type="submit" name="confirm" class="btn btn-danger mr-2">Confirmer</button>
                    <a href="index.php" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </body>
        </html>
        <?php
        exit();
    }
}

// Rediriger vers la page index.php si l'ID de l'étudiant n'est pas spécifié ou s'il n'existe pas
header("Location: index.php");
exit();
?>
