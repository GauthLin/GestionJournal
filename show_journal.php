<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Aperçu d'un journal</title>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <?php
            include "functions.php";

            // Affiche le titre
            $file = $_GET['file'];
            echo '<h1>Journal du '. convertDate2Title($file) .'</h1>';
            ?>
        </div>

        <div class="text-right">
            <?php
            // Affiche les boutons d'action
             echo '<a href="index.php" class="btn btn-default btn-lg">Retour à la page d\'accueil</a>';
             ?>
        </div>

        <?php
        // Lit le fichier xml
        $xml = readXML($file);

        // Affiche les différents articles avec leur bouton "Modifier" et "Supprimer"
        foreach ($xml['articles'] as $key => $article) {
            echo '<div class="page-header" style="margin: 0 !important;">
                    <h2>'. $article['titre'] .'<small> par '. $article['auteur'] .'   </small>
                        <span class="pull-right">
                            <a href="modify_article.php?file='.$file.'&amp;num='.$key.'" class="btn btn-sm btn-success">Modifier</a> 
                            <a href="delete_article.php?file='.$file.'&amp;num='.$key.'" class="btn btn-danger btn-sm">Supprimer</a>
                        </span>
                    </h2>
                </div>';
            echo '<div class="well">'. $article['contenu'] .'</div>';
        }

        // Affiche le bouton d'ajout d'un nouvel article au journal ainsi qu'un bouton pour supprimer le journal
        echo '<div class="text-right">
                <a href="add_article.php?file='.$file.'" class="btn btn-success">Ajouter un nouvel article</a>
                <a href="delete_journal.php?file='.$file.'" class="btn btn-danger">Supprimer le journal</a>
            </div>';
        ?>
    </div>
    <footer>
        Gauthier Linard | Tous droits réservés &copy; 2016
    </footer>
</body>
</html>
