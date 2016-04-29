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
             echo '<li class="list-group-item">
                <a href="show_journal.php?file='.$file.'">Journal du '. convertDate2Title($file) .'</a>
                <a href="delete_journal.php?file='.$file.'" class="btn btn-danger btn-sm">Supprimer</a>
                <a href="print_journal.php?file='.$file.'" class="btn btn-info btn-sm">Imprimer</a>
                </li>';
         }
     }
     echo '</ul>';
     ?>
 </div>
</body>
</html>
