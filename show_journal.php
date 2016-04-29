<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Page d'accueil</title>
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

        // Affiche les différents articles
        foreach ($xml['articles'] as $key => $article) {
            echo '<div class="page-header"><h2>'. $article['titre'] .'<small> par '. $article['auteur'] .'   </small><span class="pull-right"><a href="modify_article.php?file='.$file.'&amp;num='.$key.'" class="btn btn-sm btn-success">Modifier</a> <a href="delete_article.php?file='.$file.'&amp;num='.$key.'" class="btn btn-danger btn-sm">Supprimer</a><span></span></h2></div>';
            echo '<div class="well">'. $article['contenu'] .'</div>';
        }

        echo '<div class="text-right"><a href="add_article.php?file='.$file.'" class="btn btn-success">Ajouter un nouvel article</a></div>';
        ?>
    </div>
</body>
</html>