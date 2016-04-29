<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
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

            $data = array();

            $date = trim($_POST['date']);
            $titres = $_POST['titre'];
            $auteurs = $_POST['auteur'];
            $contenus = $_POST['contenu'];

            $data['date'] = $date;

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
            <!-- Affichage du formulaire de création du journal -->
            <div class="alert alert-info">
                Veuillez indiquer la date du journal. Ensuite, cliquez sur "<strong>Créer le journal</strong>".
            </div>
            <form action="create_journal.php" method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="date" class="col-sm-2 control-label">Date du journal</label>
                    <div class="col-sm-10">
                        <input type="date" name="date" id="date" class="form-control">
                    </div>
                </div>

                <fieldset id="article_1">
                    <h2>Article 1</h2>

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
                </fieldset>

                <div class="text-right">
                    <input type="submit" class="btn btn-success" value="Créer le journal">
                    <a href="index.php" class="btn btn-default">Retour à la page d\'accueil</a>
                </div>
            </form>
        <?php
        }
        ?>
    </div>
</body>
</html>