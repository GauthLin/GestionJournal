<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Impression d'un journal</title>
</head>
<body>
<div class="container">
    <div class="page-header">
        <?php
        include "functions.php";

        // Affiche le titre
        $file = $_GET['file'];
        echo '<h1>Impression d\'un journal</h1>';

        // Chargement du template XSLT
        $xslfilename = 'template.xslt';
        $xslfile = new DOMDocument();
        $xslfile->load($xslfilename);

        // Chargement du fichier XML à transformer
        $xmlfile = new DOMDocument();
        $xmlfile->load('xml/'.$file);

        $xsl = new XSLTProcessor();
        //$xsl->setParameter('', 'title', $titre);
        $xsl->importStyleSheet($xslfile);
        $content = $xsl->transformToXML($xmlfile);

        $temp = fopen('temp/xml.fo', 'w');
        fwrite($temp,$content);
        fclose($temp);

        $pdfname = trim(basename('xml/'.$file, '.xml') .'.pdf');
        // Imprime le journal
        exec("C:/wamp64/www/GestionJournal/fop/fop.bat temp/xml.fo journal/$pdfname 2>&1", $output);

        echo '<div class="alert alert-info">Le journal a bien été imprimé au format pdf. Vous pouvez le trouver dans le dossier <strong>journal/'.$pdfname.'</strong>. <a href="index.php">Cliquez ici</a> pour retourner à la page d\'accueil.</div>';
        ?>
    </div>
</div>
<footer>
    Gauthier Linard | Tous droits réservés &copy; 2016
</footer>
</body>
</html>
