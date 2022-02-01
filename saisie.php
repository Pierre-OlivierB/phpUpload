<?php
// Inclusion du fchier qui contient les fonctions générales.
// include('fonctions.inc');
// Initialisation de la variable de message.
function vers_page($valeur) {
    return nl2br(htmlentities($valeur,ENT_QUOTES,'UTF-8'));
   }
$message = '';
// Traitement du formulaire.
if (isset($_POST['ok'])) {
    // Récupérer les informations sur le fchier.
    $informations = $_FILES["fichier"];
    // En extraire :
    // - son nom.
    $nom = $informations['name'];
    // - son type MIME.
    $type_mime = $informations['type'];
    // - sa taille.
    $taille = $informations['size'];
    // - l'emplacement du fchier temporaire.
    $fchier_temporaire = $informations['tmp_name'];
    // - le code d'erreur.
    $code_erreur = $informations['error'];
    // Contrôles et traitement.
    switch ($code_erreur) {
        case UPLOAD_ERR_OK:
            // Fichier bien reçu.
            // Déterminer sa destination fnale.
            $destination = "/app/documents/$nom";
            // Copier le fchier temporaire (tester le résultat).
            if (copy($fchier_temporaire, $destination)) {
                // Copie OK => mettre un message de confrmation.
                $message = "Transfert terminé - Fichier = $nom - ";
                $message .= "Taille = $taille octets - ";
                $message .= "Type MIME = $type_mime.";
            } else {
                // Problème de copie => mettre un message d'erreur.
                $message = 'Problème de copie sur le serveur.';
            }
            break;
        case UPLOAD_ERR_NO_FILE:
            // Pas de fchier saisi.
            $message = 'Pas de fchier saisi.';
            break;
        case UPLOAD_ERR_INI_SIZE:
            // Taille fchier > upload_max_flesize.
            $message = "Fichier '$nom' non transféré ";
            $message .= ' (taille > upload_max_flesize).';
            break;
        case UPLOAD_ERR_FORM_SIZE:
            // Taille fchier > MAX_FILE_SIZE.
            $message = "Fichier '$nom' non transféré ";
            $message .= ' (taille > MAX_FILE_SIZE).';
            break;
        case UPLOAD_ERR_PARTIAL:
            // Fichier partiellement transféré.
            $message = "Fichier '$nom' non transféré ";
            $message .= ' (problème lors du tranfert).';
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            // Pas de répertoire temporaire.
            $message = "Fichier '$nom' non transféré ";
            $message .= ' (pas de répertoire temporaire).';
            break;
        case UPLOAD_ERR_CANT_WRITE:
            // Erreur lors de l'écriture du fchier sur disque.
            $message = "Fichier '$nom' non transféré ";
            $message .= ' (erreur lors de l\'écriture du fchier sur
disque).';
            break;
        case UPLOAD_ERR_EXTENSION:
            // Transfert stoppé par l'extension.
            $message = "Fichier '$nom' non transféré ";
            $message .= ' (transfert stoppé par l\'extension).';
            break;
        default:
            // Erreur non prévue !
            $message = "Fichier non transféré ";
            $message .= " (erreur inconnue : $code_erreur ).";
    }
}
?>
<!DOCTYPE html <html>

<head>
    <meta charset="utf-8" />
    <title>Upload</title>
    <title>Upload</title>
</head>

<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <div>
            Fichier :
            <input size="100" type="file" name="fchier" />
            <input type="submit" name="ok" value="OK" /><br />
            <?php echo vers_page($message); ?>
        </div>
    </form>
</body>

</html>