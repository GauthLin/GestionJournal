<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Ajout d'un article</title>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <?php
            include "functions.php";

            // Affiche le titre
            $file = $_GET['file'];
            $num = intval($_GET['num']);  # Numéro de l'article à supprimer
            echo '<h1>Suppression d\'un article</h1>';

            $data = readXML($file);

            // Compte le nombre d'article que possède le journal
            $nbArticle = count($data['articles']);
            // Si le numéro de l'article ne fait pas partie du journal -> erreur
            if ($nbArticle < $num + 1) {
                echo '<div class="alert alert-warning">Le numéro de cette article n\'existe pas ou a déjà été supprimé. <a href="show_journal.php?file='.$file.'">Cliquez ici</a> pour retourner au journal.</div>';
            } else {
                // Sinon on traite
                unset($data['articles'][$num]);
                deleteXML($file);
                createXML($data);

                echo '<div class="alert alert-success">L\'article a bien été supprimé. <a href="show_journal.php?file='.$file.'">Cliquez ici</a> pour retourner sur le journal.</div>';
            }
            ?>
        </div>
    </div>
    <footer>
        Gauthier Linard | Tous droits réservés &copy; 2016
    </footer>
</body>
</html>
