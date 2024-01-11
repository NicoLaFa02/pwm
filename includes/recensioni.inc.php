<!-- controllo errori -->
<?php
require_once '../includes/dbh.inc.php';
require_once '../includes/functions.inc.php';

// verifico se l'utente è loggato
session_start();
//se non è stato effettuato l'accesso allora non è possibile lasciare recensioni
if (!isset($_SESSION["username"])){
    header("location: ../img/index.php");
    exit();
}
//è necessario entrare nella pagina tramite un pulsante submit che mandi in post il campoID
if(!(isset($_POST["submit"]))){
    header("location: ../img/index.php");
    exit();
}

if (isset($_POST["campoID"])) {
    // Query per ottenere le informazioni dell'utente dal DB
    $user = getUserInfo($conn, $_SESSION["username"]);
    
    $username = $user["username"];
    $UID = $user["UID"];
    

    // Query per ottenere le informazioni dell'campo dal DB
    $campoData = getCampoInfo($conn, $_POST["campoID"]);


    $campoID = $campoData["campoID"];

    $testo_recensione = $_POST["testo_rec"];
    $voto_recensione = $_POST["voto_rec"];

    // Query per inserire la recensione nel database
    $query = "INSERT INTO recensioni (testo_recensione, utente_id, campoID_r, username, data_creazione_rec, voto) VALUES (?, ?, ?, ?, current_timestamp(), ?)";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, "siisi", $testo_recensione, $UID, $campoID, $username, $voto_recensione);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }


    // Query per aggiornare il numero di recensioni e la votazione media
    $stmt = mysqli_stmt_init($conn);
    $query = "UPDATE campoDaCalcio SET numeroRecensioni = numeroRecensioni + 1, votazioneCampo = (votazioneCampo * numeroRecensioni + ?) / (numeroRecensioni + 1), ultima_rec = current_timestamp() WHERE campoID = ?";
    if (mysqli_stmt_prepare($stmt, $query)) {
        $voto_aggiornato = ($campoData['votazioneCampo'] * $campoData['numeroRecensioni'] + $voto_recensione) / ($campoData['numeroRecensioni'] + 1);
        mysqli_stmt_bind_param($stmt, "di", $voto_aggiornato, $campoID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }


    header("location: ../img/index.php");
    exit(); 

} else {
    echo "Campo non specificato.";
}