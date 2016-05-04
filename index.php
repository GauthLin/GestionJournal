<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Page d'accueil</title>
</head>
<body>
    <div class="container">
         <div class="page-header">
             <h1>Journal Gauthier</h1>
         </div>

         <div class="text-right">
             <a href="create_journal.php" class="btn btn-success btn-lg">Créer un nouveau journal</a>
         </div>

         <?php
         include "functions.php";

         // Permet de lister tous les journaux enregistrés
         $files = scandir('xml');

         echo '<ul class="list-group">';
         foreach ($files as $file) {
             # Si c'est pas un fichier spécial -> traitement
             if ($file != '.' and $file != '..') {
                 echo '<li class="list-group-item row">
                    <span class="col-sm-9">Journal du '. convertDate2Title($file) .'</span>
                    <span class="col-sm-3 text-right">
                        <a href="show_journal.php?file='.$file.'" class="btn btn-warning btn-xs">Modifier</a>
                        <a href="delete_journal.php?file='.$file.'" class="btn btn-danger btn-xs">Supprimer</a>
                        <a href="print_journal.php?file='.$file.'" class="btn btn-info btn-xs">Imprimer</a>
                    </span>
                    </li>';
             }
         }
         echo '</ul>';
         ?>
    </div>
    <footer>
     Gauthier Linard | Tous droits réservés &copy; 2016
    </footer>
</body>
</html>
