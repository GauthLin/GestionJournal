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

                // Récupère les informations du journal
                $data = readXML($file);
                echo '<h1>Modification du journal du '. convertDate2Title($file) .'</h1>';
                ?>
            </div>
        
            <?php
            // Si le formulaire a été envoyé
            if (isset($_POST['titre'])) {
                $data['articles'][$num] = [
                    'titre' => $_POST['titre'],
                    'auteur' => $_POST['auteur'],
                    'contenu' => $_POST['contenu']
                ];
        
                // Supprime le journal
                deleteXML($file);
                // recrée le journal avec l'article modifié
                createXML($data);
        
                echo '<div class="alert alert-success">L\'article a bien été modifié. <a href="show_journal.php?file='.$file.'">Cliquez ici</a> pour afficher le journal.</div>';
            } else { ?>
                <!-- Affichage du formulaire de création de l'article -->
                <div class="alert alert-info">
                    Pour modifier un article au journal, corrigez les champs ci-dessous. Ensuite, cliquez sur "<strong>Modifier l'article</strong>".
                </div>
                <form action="modify_article.php?file=<?php echo $file; ?>&amp;num=<?php echo $num; ?>" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="titre" class="col-sm-2 control-label">Titre</label>
                        <div class="col-sm-10">
                            <input type="text" name="titre" id="titre" class="form-control" value="<?php echo $data['articles'][$num]['titre']; ?>">
                        </div>
                    </div>
        
                    <div class="form-group">
                        <label for="auteur" class="col-sm-2 control-label">Auteur</label>
                        <div class="col-sm-10">
                            <input type="text" name="auteur" id="auteur" class="form-control" value="<?php echo $data['articles'][$num]['auteur']; ?>">
                        </div>
                    </div>
        
                    <div class="form-group">
                        <label for="contenu" class="col-sm-2 control-label">Contenu</label>
                        <div class="col-sm-10">
                            <textarea rows="5" name="contenu" id="contenu" class="form-control"><?php echo $data['articles'][$num]['contenu']; ?></textarea>
                        </div>
                    </div>
        
                    <div class="text-right">
                        <a href="show_journal.php?file=<?php echo $file;?>&amp;num=<?php echo $num;?>" class="btn btn-default">Retour au journal</a>
                        <input type="submit" value="Modifier l'article" class="btn btn-success">
                    </div>
                </form>
                <?php
            }
            ?>
        </div>
        <footer>
            Gauthier Linard | Tous droits réservés &copy; 2016
        </footer>
    </body>
</html>
