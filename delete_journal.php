<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <title>Suppression d'un journal</title>
    </head>
    <body>
        <div class="container">
            <div class="page-header">
                <h1>Suppression d'un journal</h1>
            </div>
    
            <?php
            include 'functions.php';
    
            $file = $_GET['file'];
    
            // Si le fichier existe alors, suppression
            if (file_exists('xml/'.$file)) {
                deleteXML($file);
    
                echo '<div class="alert alert-success">Le journal a bien été supprimé. <a href="index.php">Cliquez ici</a> pour revenir à la page d\'accueil.</div>';
            } else {
                echo '<div class="alert alert-danger">Le journal demandé n\'existe pas ou a déjà été supprimé. <a href="index.php">Cliquez ici</a> pour revenir à la page d\'accueil.</div>';
            }
            ?>
        </div>
        <footer>
            Gauthier Linard | Tous droits réservés &copy; 2016
        </footer>
    </body>
</html>
