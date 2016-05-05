<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <title>Création d'un journal</title>
    </head>
    <body>
        <div class="container">
            <div class="page-header">
                <h1>Création d'un nouveau journal</h1>
            </div>

            <?php
            // Si le formulaire a été envoyé
            if (isset($_POST['date'])) {
                include "functions.php";

                $data = array(
                    'date' => trim($_POST['date']),
                    'articles' => array(
                        array(
                            'titre' => $_POST['titre'],
                            'auteur' => $_POST['auteur'],
                            'contenu' => $_POST['contenu']
                        )
                    )
                );

                createXML($data);

                echo '<div class="alert alert-success">Le journal a bien été enregistré. <a href="index.php">Cliquez ici</a> pour revenir à la page d\'accueil.</div>';
            } else { ?>
                <!-- Affichage du formulaire de création du journal -->
                <div class="alert alert-info">
                    Veuillez compléter les champs présents ci-dessous afin de créer un nouveau journal. Ensuite, cliquez sur "<strong>Créer le journal</strong>".
                </div>
                <form action="create_journal.php" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="date" class="col-sm-2 control-label">Date du journal</label>
                        <div class="col-sm-10">
                            <input type="date" name="date" id="date" class="form-control">
                        </div>
                    </div>

                    <div class="alert alert-info">
                        Veuillez compléter le premier article de ce journal. Vous pourrez en ajouter plus par la suite.
                    </div>

                    <div class="form-group">
                        <label for="titre" class="col-sm-2 control-label">Titre</label>
                        <div class="col-sm-10">
                            <input type="text" name="titre" id="titre" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="auteur" class="col-sm-2 control-label">Auteur</label>
                        <div class="col-sm-10">
                            <input type="text" name="auteur" id="auteur" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="contenu" class="col-sm-2 control-label">Contenu</label>
                        <div class="col-sm-10">
                            <textarea rows="5" name="contenu" id="contenu" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="text-right">
                        <input type="submit" class="btn btn-success" value="Créer le journal">
                        <a href="index.php" class="btn btn-default">Retour à la page d\'accueil</a>
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