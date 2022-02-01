<?php
// Liste des documents (viendrait sans doute d'une
// base de données dans une vraie application).
$documents = array('cv.pdf', 'photo.png');
// Traitement du formulaire si $_GET non vide.
if (!empty($_GET)) {
    // Récupérer le numéro du document.
    $numéro = $_GET['no'];
    // En déduire le nom du document.
    $nom_fchier = $documents[$numéro];
    // Envoyer l'en-tête d'attachement.
    $header = "Content-Disposition: attachment; ";
    $header .= "flename=$nom_fchier\n";
    header($header);
    // Envoyer l'en-tête du type MIME (ici, "inconnu").
    header("Content-Type: x/y\n");
    // Envoyer le document.
    readfile($nom_fchier);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Download</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table,
        td,
        th {
            border: 1px solid black;
        }

        td,
        th {
            padding: 4px;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <th>document</th>
        </tr>
        <?php
        // Un petit bout de code PHP pour générer les lignes du
        // tableau présentant la liste des documents.
        // Parcourir la liste des documents et utiliser le nom
        // pour l'afchage et le numéro dans l'URL.
        foreach ($documents as $numéro => $document) {
            echo sprintf(
                "<tr><td>%s</td></tr>\n",
                "<a href=\"download.php?no=$numéro\">$document</a>"
            );
        }
        ?>
    </table>
</body>

</html>