<?php
// Liste des documents (viendrait sans doute d'une
// base de données dans une vraie application).
$documents = array('cv.pdf', 'photo.png');
// Traitement du formulaire si $_POST non vide.
if (!empty($_POST)) {
    // Récupérer le numéro du document.
    // Prendre la clé de la première ligne de $_POST
    // (normalement du type n_x, n étant le numéro du document).
    list($numéro) = each($_POST);
    // Convertir la chaîne en entier => seul le n° reste.
    $numéro = (int) $numéro;
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
<!DOCTYPE html <html>

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
    <form action="Download.php" method="post">
        <table>
            <tr>
            <th>document</th>
            <th>télécharger</th>
            </tr>
            <?php
            // Un petit bout de code PHP pour générer les lignes du
            // tableau présentant la liste des documents.
            // Parcourir la liste des documents et utiliser le nom
            // pour l'afchage et le numéro comme nom de l'image.
            foreach ($documents as $numéro => $document) {
                echo sprintf(
                    "<tr><td>%s</td><td style=\"text-align:center\">%s</td></tr>\n",
                    $document,
                    "<input type=\"image\" name=\"$numéro\"alt=\"download\" src=\"download.png\" />"
                );
            }
            ?>
        </table>
    </form>
</body>

</html>