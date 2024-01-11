<?php
require_once '../includes/dbh.inc.php';
require_once '../includes/functions.inc.php';
// session_start(); //non credo sia necessario fare partire la sessione se non è necessario essere loggati

// if(!isset($_POST["submit"])){
//     header("location: ../img/impostazioni.php");
//     exit();
// } Non devo per forza arrivare da un tasto

if (isset($_GET["campoID"])) {

    $campoID = $_GET["campoID"];

    // Query per ottenere le informazioni dell'campo dal DB
    
    $campoData = getCampoInfo($conn, $campoID);
    $nomeCampo = $campoData['$nomeCampo'];
    
    stampaCampo($conn, $campoID);

        // Query per ottenere tutte le recensioni per un determinato campoID
    $query = "SELECT id_recensione, testo_recensione, utente_id, campoID_r, username, data_creazione_rec, voto
    FROM recensioni
    WHERE campoID_r = ?";

    // Preparazione dello statement
    $stmt = $conn->prepare($query);

    // Bind del parametro
    $stmt->bind_param("i", $campoID);

    // Esecuzione della query
    $stmt->execute();

    // Associazione delle variabili di output
    $stmt->bind_result($id_recensione, $testo_recensione, $utente_id, $campoID_r, $username, $data_creazione_rec, $voto);

    // Fetch dei risultati
    while ($stmt->fetch()) {
    // Stampare o elaborare i dati ottenuti
    echo "ID Recensione: $id_recensione<br>";
    echo "Testo Recensione: $testo_recensione<br>";
    echo "ID Utente: $utente_id<br>";
    echo "Username: $username<br>";
    echo "Data Creazione Recensione: $data_creazione_rec<br>";
    echo "<hr>";
    }

    // Chiusura dello statement
    $stmt->close();


}