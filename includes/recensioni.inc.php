<!-- controllo errori -->
<?php
require_once '../includes/dbh.inc.php';
require_once '../includes/functions.inc.php';

// verifico se l'utente è loggato
session_start();
//se non è stato effettuato l'accesso allora non esistono impostazioni utente
if (!isset($_SESSION["username"])){
    header("location: ../img/index.php");
    exit();
}

if (isset($_GET["campoID"])) {
    // Query per ottenere le informazioni dell'utente dal DB
    $stmt = $conn->prepare("SELECT * FROM utenti WHERE username = ?");
    $stmt->bind_param("s", $_SESSION["username"]);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    }
    $stmt->close();

    $username = $user["username"];
    $UID = $user["UID"];
    
    // Query per ottenere le informazioni dell'utente dal DB
    $stmt = $conn->prepare("SELECT * FROM campoDaCalcio WHERE campoID = ?");
    $stmt->bind_param("i", $_GET["campoID"]);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $campoData = $result->fetch_assoc();
    }
    $stmt->close();

    $campoID = $campoData["campoID"];

    $testo_recensione = $_POST["testo_rec"];
    $voto_recensione = $_POST["voto_rec"];

    // Query per inserire la recensione nel database
    $stmt = $conn->prepare("INSERT INTO recensioni (testo_recensione, utente_id, campoID_r, username, data_creazione_rec, voto) VALUES (?, ?, ?, ?, current_timestamp(), ?)");
    $stmt->bind_param("siisi", $testo_recensione, $UID, $campoID, $username, $voto_recensione);
    $stmt->execute();
    $stmt->close();

    // Query per aggiornare il numero di recensioni e la votazione media
    $stmt = $conn->prepare("UPDATE campoDaCalcio SET numeroRecensioni = numeroRecensioni + 1, votazioneCampo = (votazioneCampo + ?) / (numeroRecensioni + 1), ultima_rec = current_timestamp() WHERE campoID = ?");
    $voto_aggiornato = ($campoData['votazioneCampo'] * $campoData['numeroRecensioni'] + $voto_recensione) / ($campoData['numeroRecensioni'] + 1);    $stmt->bind_param("di", $voto_aggiornato, $campoID);
    $stmt->execute();
    $stmt->close();

    
} else {
    echo "Campo non specificato.";
}