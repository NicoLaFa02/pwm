<?php
require_once '../includes/dbh.inc.php';
require_once '../includes/functions.inc.php';

if (isset($_GET['campoID'])) {
    $campoID = $_GET['campoID'];

    // Ottieni le recensioni per il campo specificato
    $recensioni = getRecensioniCampo($conn, $campoID);

    if ($recensioni) {
        // Se ci sono recensioni, visualizzale
        foreach ($recensioni as $recensione) {
            $nomeUtente = $recensione['username']; // Supponendo che 'username' sia il campo relativo al nome utente

            // Visualizza le informazioni della recensione
            echo "<div>";
            echo "<p>Recensione di: $nomeUtente</p>";
            echo "<p>Voto: {$recensione['voto']}</p>"; // Supponendo che 'voto' sia il campo relativo al voto
            echo "<p>Testo: {$recensione['testo']}</p>"; // Supponendo che 'testo' sia il campo relativo al testo della recensione
            echo "</div>";
        }
    } else {
        echo "Nessuna recensione trovata per questo campo.";
    }
} else {
    echo "Campo non specificato.";
}
?>
