<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Ajout d'un article</title>
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

    <?php
    // Si le formulaire a été envoyé
    if (isset($_POST['date'])) {
        $data = array();

        $titres = $_POST['titre'];
        $auteurs = $_POST['auteur'];
        $contenus = $_POST['contenu'];

        foreach ($titres as $key => $titre) {
            $data['articles'][] = [
                'titre' => $titre,
                'auteur' => $auteurs[$key],
                'contenu' => $contenus[$key]
            ];
        }

        createXML($data);

        echo '<div class="alert alert-success">Le journal a bien été enregistré. <a href="index.php">Cliquez ic</a> pour revenir à la page d\'accueil.</div>';
    } else { ?>
        <!-- Affichage du formulaire de création de l'article -->
        <div class="alert alert-info">
            Pour ajouter un article au journal, remplissez le champs ci-dessous. Ensuite, cliquez sur "<strong>Créer l'article</strong>".
        </div>
        <form action="add_article.php?file=<?php echo $file; ?>" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="titre[]" class="col-sm-2 control-label">Titre</label>
                <div class="col-sm-10">
                    <input type="text" name="titre[]" id="titre[]" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="auteur[]" class="col-sm-2 control-label">Auteur</label>
                <div class="col-sm-10">
                    <input type="text" name="auteur[]" id="auteur[]" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="contenu[]" class="col-sm-2 control-label">Contenu</label>
                <div class="col-sm-10">
                    <textarea rows="5" name="contenu[]" id="contenu[]" class="form-control"></textarea>
                </div>
            </div>

            <div class="text-right">
                <a href="show_journal.php?file=<?php echo $file;?>" class="btn btn-default">Retour au journal</a>
                <input type="submit" value="Créer l'article" class="btn btn-success">
            </div>
        </form>
        <?php
    }
    ?>
</div>
</body>
</html>
