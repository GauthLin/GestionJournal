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

        exec("fop/fop.bat temp/xml.fo journal.pdf", $output, $returnvar);
        var_dump($output, $returnvar);
        ?>
    </div>
</div>
<footer>
    Gauthier Linard | Tous droits réservés &copy; 2016
</footer>
</body>
</html>
