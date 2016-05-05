<?php
/**
 * Permet de lire un fichier xml
 *
 * @param $filename String Nom du fichier a lire
 * @return array Retourne un tableau contenant les valeurs du fichier xml lu
 */
function readXML($filename) {
    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom->load('xml/'.$filename);
    $articles = $dom->getElementsByTagName('article');

    $data = array();
    $data['date'] = $dom->getElementsByTagName('journal')->item(0)->getAttribute('date');

    if ($articles->length) {
        foreach($articles as $article) {
            $titre = $article->getElementsByTagName('titre')->item(0);
            $auteur = $article->getElementsByTagName('auteur')->item(0);
            $contenu = $article->getElementsByTagName('contenu')->item(0);

            $data['articles'][] = [
                'titre' => $titre->nodeValue,
                'auteur' => $auteur->nodeValue,
                'contenu' => $contenu->nodeValue
            ];
        }
    }

    return $data;
}

/**
 * Permet de créer un nouveau fichier xml sur base des données passées en paramètre
 *
 * @param $data array Tableau contenant toutes les données à insérer dans le xml
 */
function createXML(array $data) {
    $dom = new DOMDocument('1.0', 'UTF-8');

    $racine = $dom->createElement('journal');
    $racine->setAttribute('date', $data['date']);
    $dom->appendChild($racine);

    foreach ($data['articles'] as $article) {
        $domArticle = $dom->createElement('article');
        $racine->appendChild($domArticle);

        $titre = $dom->createElement('titre', $article['titre']);
        $domArticle->appendChild($titre);

        $auteur = $dom->createElement('auteur', $article['auteur']);
        $domArticle->appendChild($auteur);

        $contenu = $dom->createElement('contenu', $article['contenu']);
        $domArticle->appendChild($contenu);
    }

    $dom->save('xml/journal_'. $data['date'] .'.xml');
}

/**
 * Supprime le fichier xml
 *
 * @param $filename String Le nom du fichier à supprimer
 */
function deleteXML($filename) {
    if (file_exists('xml/'.$filename)) {
        unlink('xml/'.$filename);
    }

    if (file_exists('journal/'. basename($filename, '.xml') .'.pdf')) {
        unlink('journal/'. basename($filename, '.xml') .'.pdf');
    }
}

/**
 * Permet de convertir un nom de fichier en un texte
 *
 * @param $file Nom du fichier à découper
 *
 * @return string Retourne un nom "Journal du dd/mm/YYYY"
 */
function convertDate2Title($file) {
    $date = explode('_', $file)[1];
    $newdate = explode('-', $date);

    # Reformate la date
    return substr($newdate[2], 0, -4) .'/'. $newdate[1] .'/'. $newdate[0];
}